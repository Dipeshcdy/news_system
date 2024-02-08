<?php

session_start();
error_reporting(0);
function validate($data)
{
    $oldPassword = getPasswordFromDatabase($data['id']);

    if (empty($data['old_password'])) {
        $_SESSION['errors']['old_password'] = "Old password is required";
    }
    elseif ($oldPassword != $data['old_password']) {
        $_SESSION['errors']['old_password'] = "Old password is not matched";
    }

    if (empty($data['new_password'])) {
        $_SESSION['errors']['new_password'] = "New password is required";
    }

    elseif (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $data['new_password'])) {
        $_SESSION['errors']['new_password'] = "First character require capital and require at leat one symbol, one number and 8 char.";
    }

    elseif ($data['new_password'] != $data['confirm_password']) {
          $_SESSION['errors']['new_password'] = "Confirm password does not match.";
    }
    
    if(isset($_SESSION['errors']))
    {
        return true;
    }
    else{
        return false;
    }
   
}

function getPasswordFromDatabase($uid){

    if ($_SESSION['isAdmin'] == true) {
        $table = "admins";
    } if ($_SESSION['isEditor'] == true) {
        $table = "editors";
    }
    include '../../includes/db_connect.php';
    $qry = "SELECT * FROM $table WHERE id = '".$_SESSION['id']."'";
    $result = $con->query($qry);
    $row = $result->fetch_assoc();
    $password = $row['password'];
    include '../../includes/db_close.php';
    return $password;

}

if (isset($_SESSION['id'])) {
    $uid = $_SESSION['id'];
}


if (isset($_POST['pass']) && isset($_SESSION['id'])) {
    $data = $_POST;
    $error = validate($data);
    if ($error == false) {
        if ($_SESSION['isAdmin'] == true) {
            $table = "admins";
            $id = $_POST['id'];
            $newPassword = $_POST['new_password'];
            $qry = "UPDATE $table SET password='".$newPassword."' WHERE id='".$id."'";
            include '../../includes/db_connect.php';
            $result = $con->query($qry);
            include '../../includes/db_close.php';
        
        if ($result==true) {
            $response = [
                'status' => 'success',
                'message' => 'Password Updated Successfully',
            ];
            
            
            $_SESSION['alert'] = $response;
            echo 
            '<script>
                window.location = "index.php";
            </script>';
        }
        else {
            $response = [
                'status' => 'error',
                'message' => 'Opps! Something Went Wrong',
            ];
            $_SESSION['alert'] = $response;
            $_SESSION['old_data']=$data;
             echo 
            "<script>
                window.location = 'update_pass.php';
            </script>";
           
        }
    }

     if ($_SESSION['isEditor'] == true) {
            $table = "editors";
            $id = $_POST['id'];
            $newPassword = $_POST['new_password'];
            $qry = "UPDATE $table SET password='".$newPassword."' WHERE id='".$id."'";
            include '../../includes/db_connect.php';
            $result = $con->query($qry);
            include '../../includes/db_close.php';
        
        if ($result==true) {
            $response = [
                'status' => 'success',
                'message' => 'Password Updated Successfully',
            ];
            $_SESSION['alert'] = $response;
            echo 
            '<script>
                window.location = "index.php";
            </script>';
        }
        else {
            $response = [
                'status' => 'error',
                'message' => 'Opps! Something Went Wrong',
            ];
            $_SESSION['alert'] = $response;
            $_SESSION['old_data']=$data;
             echo 
            "<script>
                window.location = 'update_pass.php';
            </script>";
           
        }
    }


    }

    else {
        $_SESSION['old_data']=$data;
        $response = [
            'status' => 'error',
            'message' => 'Opps! Something Went Wrong',
        ];
        $_SESSION['alert'] = $response;
        echo
        '
            <script>
            window.location = "update_pass.php";
            </script>
        ';
    }
}

session_write_close();
?>
<?php

session_start();

function validate($data)
{
    
    if (empty($data['new_password'])) {
        $_SESSION['errors']['new_password'] = "password is required";
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


if (isset($_POST['pass_change'])) {
    $data = $_POST;
    $error = validate($data);
    include '../../includes/db_connect.php';

    if ($error == false) {
        $id = $_POST['id'];
        $newPass = $_POST['new_password'];
        
        $qry = "update editors set password='".$newPass."' where id='".$id."'";
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
                window.location = 'change_password.php';
            </script>";
           
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
            window.location = "change_password.php";
            </script>
        ';
    }

    
}

session_write_close();


?>
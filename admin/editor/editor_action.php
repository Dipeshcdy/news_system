<?php

session_start();

function validate($data,$for)
{
    if (empty($data['username'])) {
        $_SESSION['errors']['username'] = "User name is required";
        
    }
    elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['username'])) {
        $_SESSION['errors']['username'] = "Only String character required";
    }
    if (empty($data['email'])) {
        $_SESSION['errors']['email'] = "Email is required";
    }
    elseif (!preg_match("/^(?=[a-zA-Z])[a-zA-Z0-9._-]+@(?=[a-zA-Z])[a-zA-Z0-9.-]+.[a-zA-Z.]{2,6}$/",$data['email'])) {
       $_SESSION['errors']['email'] = "Email Format is incorrect"; 
    }
    if (empty($data['password'])) {
        $_SESSION['errors']['password'] = "password is required";
    }

    elseif (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $data['password'])) {
        $_SESSION['errors']['password'] = "First character require capital and require at leat one symbol and one number and 8 char.";
    }
    
    if(isset($_SESSION['errors']))
    {
        return true;
    }
    else{
        return false;
    }
   
}

if (isset($_POST['add'])) {
    $data=$_POST;
    $error=validate($data,"add");
    if ($error==false) {
        $uname = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $qry = "insert into editors(username,email,password) values('".$uname."','".$email."','".$pass."')";
        include '../../includes/db_connect.php';
        $result = $con->query($qry);
        include '../../includes/db_close.php';
        if ($result==true) {
            $response = [
                'status' => 'success',
                'message' => 'Editor Assigned Successfully',
            ];
            
            
            $_SESSION['alert'] = $response;
            echo 
            '<script>
                window.location = "index.php";
            </script>';
        }

        else{
            $response = [
                'status' => 'error',
                'message' => 'Opps! Something Went Wrong',
            ];
            $_SESSION['alert'] = $response;
           echo 
            '<script>
                window.location = "create.php";
            </script>';

        }
    }
    else{
        $response = [
            'status' => 'error',
            'message' => 'Opps! Something Went Wrong',
        ];
        $_SESSION['alert'] = $response;
        $_SESSION['old_data']=$data;
        echo 
            '<script>
                window.location = "create.php";
            </script>';
    }

}


session_write_close();
?>
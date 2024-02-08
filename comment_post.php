<?php

session_start();

function validate($data)
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
    elseif (!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
       $_SESSION['errors']['email'] = "Email Format is incorrect"; 
    }
    
    if (empty($data['comment'])) {
        $_SESSION['errors']['comment'] = "Comment is required";
    }
    
    if(isset($_SESSION['errors']))
    {
        return true;
    }
    else{
        return false;
    }
   
}




if (isset($_POST['news_comment']))
{

    $data = $_POST;
    $error = validate($data);

    include 'includes/db_connect.php';
    $name = $_POST['username'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $news_id = $_POST['news_id'];
    if ($error == false) {
    $qry = "insert into comments(username,email,comment,is_approve,news_id,created_at,updated_at) values('".$name."','".$email."','".$comment."',0,'".$news_id."',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
    $result=$con->query($qry);
    include 'includes/db_close.php';

    if($result==true)
    {
        $response = [
            'status' => 'success',
            'message' => 'Your Comment Posted Successfully',
        ];
        
        
        $_SESSION['alert'] = $response;
        echo
        "<script>
            window.location='content.php?id=".$news_id."';
        </script>       
        ";
        }
    }
    else
    {

        $_SESSION['old_data']=$data;
        $response = [
            'status' => 'error',
            'message' => 'Opps! Something Went Wrong',
        ];
        $_SESSION['alert'] = $response;
        echo
        "<script>
            window.location='content.php?id=".$news_id."';
        </script>       
        ";
    }
    
}

session_write_close();
?>
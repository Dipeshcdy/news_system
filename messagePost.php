<?php
session_start();
function validate($data)
{
    if (empty($data['name'])) {
        $_SESSION['errors']['name'] = "Name is required";
        
    }
    elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['name'])) {
        $_SESSION['errors']['name'] = "Only String character required";
    }
    if (empty($data['email'])) {
        $_SESSION['errors']['email'] = "Email is required";
    }
    elseif (!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errors']['email'] = "Email Format is incorrect"; 
    }

    if (empty($data['message'])) {
        $_SESSION['errors']['message'] = "Message is required";
    }
    if (empty($data['address'])) {
        $_SESSION['errors']['address'] = "Address is required";
    }
   // Check if the contact number contains only digits and is exactly 10 digits long
    if (empty($data['contact']))
    {
        $_SESSION['errors']['contact'] = "Contact number is required";
    }  elseif (!preg_match("/^[0-9]{10}$/", $data['contact'])) {
        $_SESSION['errors']['contact'] = "Contact number should be exactly 10 digits";
    
        // Check if the contact number contains any non-digit characters
        if (preg_match("/[^0-9]/", $data['contact'])) {
            $_SESSION['errors']['contact'] = "Contact number should contain only digits";
        }
    }
    
    if(isset($_SESSION['errors']))
    {
        return true;
    }
    else{
        return false;
    }

}
if(isset($_POST['messageSubmit']))
{
    $data=$_POST;
    // die('hi');
    
    $name=$_POST['name'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $message=$_POST['message'];
    $error=validate($data);
    if($error==false)
    {

        include 'includes/db_connect.php';
        $qry="insert into messages(name,address,contact,email,message) values('".$name."','".$address."','".$contact."','".$email."','".$message."') ";
        $result=$con->query($qry);
        include 'includes/db_close.php';
        if($result==true)
        {
            $response = [
                'status' => 'success',
                'message' => 'Your Message Submitted Successfully',
            ];
            
            
            $_SESSION['alert'] = $response;
            echo
            "<script>
                window.location='contactUs.php';
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
            window.location='contactUs.php';
         </script>       
        ";
    }
}
?>
<?php

session_start();

function validate($data,$for)
{
    if (empty($data['cat_name'])) {
         $_SESSION['errors']['cat_name'] = "Category name is required";
    }
    elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['cat_name'])) {
        $_SESSION['errors']['cat_name'] = "Only character string is valid";
    }

    if (isset($_SESSION['errors'])) {
        return true;
    }
    else{
        return false;
    }

}

if (isset($_POST['add'])) {
    $data = $_POST;
    $error = validate($data,"add");
    if ($error == false) {
        $cat = $_POST['cat_name'];
        $qry = "INSERT INTO `categories` (`cat_name`,`created_at`,`updated_at`) VALUES ('".$cat."',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        include '../../includes/db_connect.php';
        $result = $con->query($qry);
        include '../../includes/db_close.php';

        // toastify("Category Added Successfully","success");
        if ($result == true) {
            $response = [
                'status' => 'success',
                'message' => 'Category Added Successfully',
            ];
            
            
            $_SESSION['alert'] = $response;
            echo 
            '<script>
                window.location = "index.php";
            </script>';
        }
        else {
            $_SESSION['old_data'] = $data;
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
        $_SESSION['old_data'] = $data;
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
    // toastify("Some Error Found","error");

}

if (isset($_POST['update'])) {
    $data = $_POST;
    $error = validate($data,"update");
    $id = $_POST['id'];
    if ($error == false) {
    $cat = $_POST['cat_name'];
    $qry = "update categories set cat_name = '$cat',updated_at=CURRENT_TIMESTAMP where id='$id'";
    include '../../includes/db_connect.php';
    $result =  $con->query($qry);
    include '../../includes/db_close.php';

    // toastify("Category Updated Successfully","success");
    if ($result == true) {
        $response = [
            'status' => 'success',
            'message' => 'Category Updated Successfully',
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
        echo
        '<script>
            window.location = "edit.php?id='.$id.'";
        </script>';
            //    echo "Error:" . $qry . "<br>" . $con->error;
        }
    }
    else {
        $response = [
            'status' => 'error',
            'message' => 'Opps! Something Went Wrong',
        ];
        $_SESSION['alert'] = $response;

        echo 
        '<script>
            window.location = "edit.php?id='.$id.'";
        </script>';
    }

}


session_write_close();



?>
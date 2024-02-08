<?php 
        session_start();
        session_destroy();
        $response = [
                'status' => 'success',
                'message' => 'Logged Out Successfully',
        ];
        session_start();
        $_SESSION['alert'] = $response;
        header('Location: login.php');
        exit();
        
?>
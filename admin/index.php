<?php
session_start();
if ($_SESSION['isAdmin'] == true || $_SESSION['isEditor'] == true ) {
   header('Location: dashboard');
}
else {
    header('Location: ../login.php');
}


?>
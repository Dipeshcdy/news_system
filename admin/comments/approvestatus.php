<?php
session_start();
if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    $qry = "update comments set is_approve = '1',updated_at=CURRENT_TIMESTAMP where id='".$id."'";
    include '../../includes/db_connect.php';
    $result = $con->query($qry);
    include '../../includes/db_close.php';

    if ($result == true) {
        $response = [
            'status' => 'success',
            'message' => 'Comment Approved Successfully',
        ];
        $_SESSION['alert'] = $response;
        echo '
            <script>
                window.location = "pending.php";
            </script>

             ';
    }
    else
    {
        $response = [
            'status' => 'error',
            'message' => 'Opps! Something Went Wrong',
        ];
        $_SESSION['alert'] = $response;
        echo '
            <script>
                window.location = "pending.php";
            </script>

             ';
            //    echo "Error:" . $qry . "<br>" . $con->error;

    }
}

session_write_close();

?>
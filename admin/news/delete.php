<?php
 include '../../includes/db_connect.php';

 $id=$_POST['id'];
 $targetDir="../../Images/news/";
 $news_qry="select image from news where id='$id' ";
 $news = $con->query($news_qry);
 if ($news->num_rows > 0) {
    while ($row = $news->fetch_assoc()) {
    $imagePath=$targetDir . $row['image'];
      if(file_exists($imagePath))
      {
      unlink($imagePath);
    
    }
  }
}
$qry = "delete from news where id='$id' ";
 
 if (mysqli_query($con, $qry)) {
        echo $id;
    }else {
        echo "Error: " . $qry . "<br>" . mysqli_error($con);
    }

 include '../../includes/db_close.php';


?>
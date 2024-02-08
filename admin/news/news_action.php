<?php

session_start();
 function validate($inputData,$for)
{
  // die($inputData['title']);
  if(empty($inputData['title']))
  {
    // die('empty');
  $_SESSION['errors']['title']='Title is required';
  // die($_SESSION['errors']['title']);
  }
  else if(!preg_match('/^(?=.*[a-zA-Z])[\w\s]*$/',$inputData['title']))
  {
    $_SESSION['errors']['title']='Should be combination of string and number or string only';

  }
  if(empty($inputData['desc']))
  {
  $_SESSION['errors']['desc']='Description is required';
  }
  if($for=="add")
  {
   
    if(empty($_FILES["image"]["name"]))
    {
    $_SESSION['errors']['image']='Image is required';
    }
  }
  if(isset($_SESSION['errors']))
  {
    return true;
  }
  else{
    return false;
  }
// session_write_close();
}


if (isset($_POST['add'])) {
$inputData=$_POST;
$error=validate($inputData,"add");
  if($error==false)
  {
    include '../../includes/db_connect.php';
    $title = mysqli_real_escape_string($con,$_POST['title']);
    $desc = mysqli_real_escape_string($con,$_POST['desc']);

    $category = $_POST['category'];
    $postBy= $_SESSION['username'];




    // File upload path
    $targetDir="../../Images/news/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if a file is selected
    if (!empty($_FILES["image"]["name"]))
    {
      // Allow only specific file formats (modify as needed)
      $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
      if (in_array($fileType, $allowedTypes)) {
        // Upload the file to the specified directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath))
        {
          // File uploaded successfully, insert file details into the database
          $sql = "INSERT INTO news (title,description,image,cat_id,postBy,created_at,updated_at) VALUES ('".$title."', '".$desc."','".$fileName."','".$category."','".$postBy."',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";


          if ($con->query($sql) === true)
          {
            $response = [
              'status' => 'success',
              'message' => 'News Added Successfully',
            ];
          
            $_SESSION['alert'] = $response;
            echo 
            '<script>
                window.location = "index.php";
            </script>';
          }
          else
          {
            $response = [
              'status' => 'error',
              'message' => "Error: " . $sql . "<br>" . $con->error,
            ];
            $_SESSION['alert'] = $response;
            echo 
              '<script>
                  window.location = "create.php";
              </script>';

            // echo "Error: " . $sql . "<br>" . $con->error;
          }
        } 
        else
        {
          // echo "Error uploading the file.";
          $response = [
            'status' => 'error',
            'message' => "Error uploading the file.",
          ];
          $_SESSION['alert'] = $response;
          echo 
            '<script>
                window.location = "create.php";
            </script>';
        } 
      }
      else
      {
        $response = [
          'status' => 'error',
          'message' => "Invalid file format.<br> Only JPG, JPEG, PNG, and GIF files are allowed.",
        ];
        $_SESSION['alert'] = $response;
        echo 
          '<script>
              window.location = "create.php";
          </script>';
        // echo "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
      }
    }
  } 
  else
  {
    $response = [
      'status' => 'error',
      'message' => 'Opps! Something Went Wrong',
    ];
    $_SESSION['alert'] = $response;
    $_SESSION['old_data']=$inputData;
    echo 
          '<script>
              window.location = "create.php";
          </script>';
  }

  include '../../includes/db_close.php';
}

if (isset($_POST['update'])) {
  $inputData=$_POST;
  $error=validate($inputData,"update");
  $id = $_POST['id'];
  if($error==false)
  {
    include '../../includes/db_connect.php';
    $title = mysqli_real_escape_string($con,$_POST['title']);
    $desc = mysqli_real_escape_string($con,$_POST['desc']);
  
    $category = $_POST['category'];
    $postBy= $_SESSION['username'];
    $news_qry="select image from news where id='$id' ";
    $news = $con->query($news_qry);
    include '../../includes/db_close.php';
    

    
    // Check if a file is selected
    if (!empty($_FILES["image"]["name"]))
    {
      // File upload path
      $targetDir="../../Images/news/";
      $fileName = basename($_FILES["image"]["name"]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
    
      // Allow only specific file formats (modify as needed)
      $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
      if (in_array($fileType, $allowedTypes))
      {
        // Upload the file to the specified directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath))
        {
          // File uploaded successfully, insert file details into the database
          $qry = "update news set title = '$title',description='$desc',image='$fileName',cat_id='$category',updated_at=CURRENT_TIMESTAMP where id='$id'";
          if ($news->num_rows > 0)
          {
            while ($row = $news->fetch_assoc())
            {
              $imagePath=$targetDir . $row['image'];
              if(file_exists($imagePath))
              {
                unlink($imagePath);
              
              }
            }
          }
        }
        else
        {
          // echo "Error uploading the file.";
          $response = [
            'status' => 'error',
            'message' => "Error uploading the file.",
          ];
          $_SESSION['alert'] = $response;
          echo 
            '<script>
                window.location = "edit.php?id=' . $id . '";
            </script>';
        } 
      }
      else
      {
        $response = [
          'status' => 'error',
          'message' => "Invalid file format.<br> Only JPG, JPEG, PNG, and GIF files are allowed.",
        ];
        $_SESSION['alert'] = $response;
        echo 
          '<script>
              window.location = "edit.php?id=' . $id . '";
          </script>';
        // echo "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
      }
    }
    else
    {
    $qry = "update news set title = '$title',description='$desc',cat_id='$category',updated_at=CURRENT_TIMESTAMP where id='$id'";
    }
    include '../../includes/db_connect.php';
    $result = $con->query($qry);
    include '../../includes/db_close.php';

    // toastify("Category Updated Successfully","success");
    if ($result == true)
    {
      $response = [
        'status' => 'success',
        'message' => 'News Added Successfully',
      ];

      $_SESSION['alert'] = $response;
      echo
      '<script>
      window.location = "index.php";
      </script>';
    }
    else
    {
      $response = [
        'status' => 'error',
        'message' => "Error:" . $qry . "<br>" . $con->error,
      ];
      $_SESSION['alert'] = $response;
      echo
      '<script>
      window.location = "index.php";
      </script>';
    }
    // echo "Error:" . $qry . "<br>" . $con->error;
  }
  else
  {
    $response = [
      'status' => 'error',
      'message' => 'Opps! Something Went Wrong',
    ];
    $_SESSION['alert'] = $response;
      echo
    '<script>
    window.location = "edit.php?id=' . $id . '";
    </script>';
  }
}

session_write_close();
?>
<?php

function limitWords($string, $limit)
{
    $words = explode(' ', $string); // Split the string into an array of words
    $limitedWords = array_slice($words, 0, $limit); // Extract the desired number of words
    $limitedString = implode(' ', $limitedWords); // Join the limited words back into a string
    return $limitedString;
}

function nextOffsetCalc($oldOffset,$cat_id,$newsPerPage)
{
    include 'includes/db_connect.php';
    $nextOffset = $oldOffset + $newsPerPage;
    $sqlCount = "SELECT COUNT(*) AS count FROM news WHERE cat_id = $cat_id";
    $countResult = $con->query($sqlCount);
    include 'includes/db_close.php';
    $totalNews = (int) $countResult->fetch_assoc()["count"];
    
    $data=array(
        'nextOffset'=>(int) $nextOffset,
        'totalNews'=>$totalNews
    );
    return $data;
}



if(isset($_POST['functionName']))
{
    $functionName = $_POST['functionName'];
    $oldOffset = $_POST['oldOffset'];
    $cat_id = $_POST['cat_id'];
    $newsPerPage = $_POST['newsPerPage'];
    
    // Check the function name and call the corresponding function
    if($functionName === 'nextOffsetCalc')
    {
        $data=nextOffsetCalc($oldOffset,$cat_id,$newsPerPage);
        echo json_encode($data);
    }
}


if(isset($_GET['offset']))
{
    $offset = $_GET["offset"];
    $cat_id=$_GET['cat_id'];
    $newsPerPage=$_GET['newsPerPage'];
    include 'includes/db_connect.php';
    $sql = "SELECT * FROM news WHERE cat_id = $cat_id ORDER BY created_at desc LIMIT $offset,$newsPerPage ";
    $result = $con->query($sql);
    include 'includes/db_close.php';

    if ($result->num_rows > 0)
    {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $data=nextOffsetCalc($offset,$cat_id,$newsPerPage);
        $response=array(
            'rows'=>$rows,
            'data'=>$data
        );
        echo json_encode($response);
    }
}
?>

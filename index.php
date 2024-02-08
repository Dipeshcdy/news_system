<?php 
include 'includes/header.php';
include 'includes/db_connect.php';

$categoryQuery = "SELECT * FROM categories";
$categoryResult = $con->query($categoryQuery);
$content=[];

while ($categoryRow = $categoryResult->fetch_assoc())
{
    $categoryId = $categoryRow['id'];
    $qry = "SELECT * from news where cat_id='".$categoryId."' ORDER BY created_at DESC LIMIT 6";
    $result=$con->query($qry);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($rows as $row)
    {
        $new=[
            'id'=>$row['id'],
            'title'=>$row['title'],
            'description' => $row['description'],
            'image'=>$row['image'],
            'cat_id'=>$row['cat_id'],
            'created_at'=>$row['created_at'],
        ];
        $content[$categoryRow['cat_name']][]=$new;
   }
}
$searchQuery = isset($_POST['query']) ? $_POST['query'] : '';

?>
<?php
function limitWords($string, $limit)
{
    $words = explode(' ', $string); // Split the string into an array of words
    $limitedWords = array_slice($words, 0, $limit); // Extract the desired number of words
    $limitedString = implode(' ', $limitedWords); // Join the limited words back into a string
    return $limitedString;
}
?>
 


 <!-- main content -->
<div class="pt-10 xl:px-36">
    <div class="lg:grid lg:grid-cols-7 lg:gap-5">
        <div class="col-span-5 px-10 py-5">
            <?php 

                if (!empty($searchQuery))
                {
                    // Display search results
                    $searchResults = [];
                    foreach ($content as $key => $values) {
                        foreach ($values as $item) {
                            if (stripos($item['title'], $searchQuery) !== false || stripos($item['description'], $searchQuery) !== false) {
                                $searchResults[$key][] = $item;
                            }
                        }
                    }
                
                    if (empty($searchResults))
                    {
                        echo 
                        '
                        <div class="my-10 mx-10">
                        <div class="px-10 py-10 border shadow-lg">
                        <p class="p-5 text-red-600 font-bold text-xl">No results found for your search query.</p>
                        </div>
                        </div>
                        ';
                    }
    
                    else
                    {
                        foreach ($searchResults as $key => $values)
                        {
                            echo "<div class='mt-10'>
                                    <h2 class='text-center text-xl font-bold py-2 border-t-4 border-b-2 border-black'>
                                        $key
                                    </h2>
                                    <div class='lg:grid lg:grid-cols-3 lg:gap-4 mt-4'>";
                            foreach ($values as $item)
                            {
                                echo "<div class='mt-14 h-64 lg:mt-5 cursor-pointer hover:text-blue-500 shadow-xl rounded-b-xl'>
                                        <a class='h-full' href='content.php?id=".$item['id']."'>
                                            <div class='h-[50%] overflow-hidden rounded-t-xl'>
                                                <img class='w-full rounded-t-xl' src='Images/news/{$item['image']}' alt='{$item['image']}' />
                                            </div>
                                            <p class='mx-1 h-[30%] text-justify txt-xl font-bold mt-3 px-2'>"
                                                .limitWords($item['title'],11).
                                            "</p>
                                            <p class='px-2 h-[10%] text-md font-semibold mt-2'>
                                                Posted at: <span class='text-gray-400'>".timeCalculate($item['created_at'])."</span>
                                            </p>
                                        </a>
                                    </div>";
                            }
                            echo "</div></div>";
                        }
                    }
                }
                else
                {
                    foreach ($content as $key => $values)
                    {
            ?>
                    <div class="mt-10">
                        <h2 class="text-center text-xl font-bold py-2 border-t-4 border-b-2 border-black">
                            <?php echo $key; ?>
                        </h2>
                        <div class="lg:grid lg:grid-cols-3 lg:gap-4 mt-4">
            <?php

                    
                        foreach ($values as $item)
                        {
            ?>  
                            <div class="mt-14 lg:h-64 pb-2 lg:pb-0 lg:mt-5 cursor-pointer hover:text-blue-500 shadow-xl rounded-b-xl">
                                <a class="h-full" href="content.php?id=<?php echo $item['id'] ?>">
                                    <div class="h-[50%] overflow-hidden rounded-t-xl">
                                        <img class="w-full rounded-t-xl"
                                            src="Images/news/<?php echo $item['image']; ?>"
                                            alt="<?php echo $item['image']; ?>" />
                                    </div>
                                    <p class="mx-1  h-[30%] text-justify txt-xl font-bold mt-2 px-2">
                                    <?php echo limitWords($item['title'],11);?>
                                    </p>
                                    <p class="px-2 h-[10%] text-md font-semibold mt-3">Posted at: <span class="text-gray-400"><?php
                                    $timeAgo=timeCalculate($item['created_at']);
                                    echo $timeAgo; ?></span> </p>
                                </a>
                            </div>

            <?php   
                        }
            ?>
                        </div>

                        

                    </div>
            <?php
                    }
                }
            ?>

        </div>
        <div class="col-span-2 mt-10 px-10 py-5">
             <h2 class="text-center text-xl font-bold py-2 border-t-4 border-b-2 border-black">
                 Recent News
             </h2>
             <div class="h-80 mt-9 overflow-hidden">
                <div class="marquee">
                    <?php
                    if(isset($recentNewsRows))
                    {
                        foreach ($recentNewsRows as $row) {
                    ?>
                            <a href="content.php?id=<?php echo $row['id'] ?>">
                            <h2
                                class="cursor-pointer hover:text-blue-500 text-md font-bold mt-4 pb-4 border-b border-gray-700 border-opacity-50">
                                <?php echo $row['title'] ?>
                            </h2>
                            </a>
                    <?php
                        }
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- main content ends -->
<script src="includes/sessionRemoveScript.js"></script>






<?php include 'includes/footer.php';?>
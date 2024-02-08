<?php 
include 'includes/header.php';

function limitWords($string, $limit)
{
    $words = explode(' ', $string); // Split the string into an array of words
    $limitedWords = array_slice($words, 0, $limit); // Extract the desired number of words
    $limitedString = implode(' ', $limitedWords); // Join the limited words back into a string
    return $limitedString;
}
?>

<?php

include 'includes/db_connect.php';
if(isset($_GET['id']))
{
    $newsPerPage = 2;
    $offset = 0;
    $categoryId=$_GET['id'];
    $qry="Select news.*,categories.cat_name from news INNER JOIN categories ON news.cat_id=categories.id where cat_id='".$categoryId."' ORDER BY created_at DESC LIMIT $newsPerPage OFFSET $offset";
    $result=$con->query($qry);
}
include 'includes/db_close.php';
?>

<!-- content-->
<section class="mt-24 mx-8 lg:mx-40">
    <?php
        if($result->num_rows>0)
        {
    ?>
        <h2 class="text-center text-4xl font-bold">
            <?php
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                echo $rows[0]['cat_name'];
            ?>
        </h2>
    <?php
        }
    ?>
    <div class="lg:grid lg:grid-cols-8 gap-10 mt-10">
        <div  class="col-span-5 lg:mb-0 mb-16">
            <!-- element to be in loop -->
            <div id="newsContainer">
                    <?php
                    if($result->num_rows>0)
                    {
                        foreach ($rows as $row)
                        {
                    ?>
                        <!-- element to be in loop -->
                            <div class="cursor-default text-md font-bold mt-4 pb-4 border-b border-gray-700 border-opacity-50">
                                <div class="grid grid-cols-1 md:grid-cols-5 md:gap-10 w-full">
                                    <div class="col-span-3 mt-5  md:mt-0 md:order-first order-last">
                                        <h2 class="cursor-pointer hover:text-blue-500 text-4xl mb-5">
                                            <a href="content.php?id=<?php echo $row['id'] ?>">
                                                <?php echo $row['title'] ?>
                                            </a>
                                        </h2>
                                        <span class="text-gray-400 text-sm">
                                            <?php
                                                echo date("Y-m-d", strtotime($row['created_at']));
                                            ?>
                                        </span>
                                        <p class="text-gray-800 my-2">
                                            <?php echo limitWords($row['description'],20);?>
                                            <a href="content.php?id=<?php echo $row['id'] ?>">
                                                <span class="text-gray-400 text-sm">..read more</span>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col-span-2 md:order-last order-first">
                                    <a href="content.php?id=<?php echo $row['id'] ?>">
                                        <img
                                        class=" md:h-[70%] w-full"
                                        src="Images/news/<?php echo $row['image'];?>"
                                        alt="<?php echo $row['image'];?>"
                                        />
                                    </a>
                                        
                                    </div>
                                </div>
                            </div>
                        <!-- end of div to be in loop -->
                    <?php
                        }
                    }
                    else
                    {
                    ?>
                        <h2 class="text-red-500 text-xl font-bold text-center ">
                            NO News yet.!
                        </h2>
                    <?php
                    }
                    ?>
            </div>
            <div class="flex mt-5">
                <a style="display:none;" id="loadMoreButton" onclick="loadMoreNews()" class="text-blue-600 text-lg font-semibold mx-auto text-center cursor-pointer rounded-xl hover:text-red-600 px-4 py-2">
                    More News<br>
                    <i class='text-2xl font-normal fa fa-angle-double-down'></i><br>
                </a>
            </div>
            

        </div>
            <!-- end of div to be in loop -->
        <div class="col-span-3 lg:mt-0 mt-5">
            <div class="flex">
                <h2 class="bg-red-500 px-4 py-0.5 rounded-lg text-lg text-white">
                    Recent News
                </h2>
            </div>
            <div class="h-96 overflow-hidden mt-5">
                <div class="marquee">
       
                    <!-- element to be in loop -->
                    <?php 
                    if(isset($recentNewsRows))
                    {
                        foreach ($recentNewsRows as $row )
                        {
                    ?>
                            <div class="block cursor-default text-md font-bold mt-4 pb-4 border-b border-gray-700 border-opacity-50">
                                <div class="grid grid-cols-3 gap-5">
                                    <div class="col-span-2">
                                        <span class="text-gray-400 text-sm">
                                            <?php
                                            $timeAgo=timeCalculate($row['created_at']);
                                            echo $timeAgo; 
                                            ?>
                                        </span>
                                        <h2 class="cursor-pointer hover:text-blue-500">
                                            <a href="content.php?id=<?php echo $row['id'] ?>">
                                                <?php echo $row['title'] ?>
                                            </a>
                                        </h2>
                                    </div>
                                    <div class="">
                                        <img class="w-full h-[70%]"
                                            src="Images/news/<?php echo $row['image'] ?>"
                                            alt="<?php echo $row['image'] ?>">
                                    </div>
                                </div>
                            </div>
                                
                    <?php
                        }
                    }
                    ?>
                    <!-- loop end -->

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var oldOffset=<?php echo $offset; ?>;
    var newsPerPage=<?php echo $newsPerPage; ?>;
    var loadMoreBtn=document.getElementById('loadMoreButton');
    var cat_id=<?php echo $categoryId; ?>;
    var nextOffset;
    var totalNews;
    $(document).ready(function() {
    // Attach click event to the "More News" button
        
        $.ajax({
            url: 'fetch_news.php',
            type: 'POST',
            data: {
                functionName: 'nextOffsetCalc',
                oldOffset: oldOffset,
                cat_id: cat_id,
                newsPerPage:newsPerPage
            },
            success: function(response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData);
                nextOffset=jsonData.nextOffset;
                totalNews=jsonData.totalNews;
                btnViewToogle();
            }
        });
    });

    function btnViewToogle()
    {
        if(totalNews > nextOffset)
        {
            loadMoreBtn.style.display="block";
        }
        else
        {
            loadMoreBtn.style.display="none";
                    
        }
    }

    function limitWords(string, limit) {
        var words = string.split(' '); // Split the string into an array of words
        var limitedWords = words.slice(0, limit); // Extract the desired number of words
        var limitedString = limitedWords.join(' '); // Join the limited words back into a string
        return limitedString;
    }

    function loadMoreNews() {
            $.ajax({
                url: 'fetch_news.php',
                type: 'GET',
                data: {offset: nextOffset,cat_id: cat_id,newsPerPage:newsPerPage},
                success: function(response) {
                var jsonData = JSON.parse(response);
                // var rows = JSON.parse(response.rows);
                console.log(jsonData);
                var rows=jsonData.rows;
                console.log(rows);
                    nextOffset=jsonData.data.nextOffset;
                    totalNews=jsonData.data.totalNews;
                    btnViewToogle();
                    // $("#newsContainer").append(response);
                    //append data
                    var html='';
                    rows.forEach(row => {
                        html+=`
                        <div class="cursor-default text-md font-bold mt-4 pb-4 border-b border-gray-700 border-opacity-50">
                        <div class="grid grid-cols-1 md:grid-cols-5 md:gap-10 w-full">
                            <div class="col-span-3 mt-5  md:mt-0 md:order-first order-last">
                                <h2 class="cursor-pointer hover:text-blue-500 text-4xl mb-5">
                                    <a href="content.php?id=${row.id}">
                                        ${row.title}
                                    </a>
                                </h2>
                                <span class="text-gray-400 text-sm">
                                   ${row.created_at.split(' ')[0]}
                                </span>
                                <p class="text-gray-800 my-2">
                                    ${limitWords(row.description,20)}
                                    <a href="content.php?id=${row.id}">
                                        <span class="text-gray-400 text-sm">..read more</span>
                                    </a>
                                </p>
                            </div>
                            <div class="col-span-2 md:order-last order-first">
                                <a href="content.php?id=${row.id}">
                                    <img
                                    class=" md:h-[70%] w-full"
                                    src="Images/news/${row.image}"
                                    alt="${row.image}"
                                    />
                                </a>

                                
                            </div>
                        </div>
                    </div>
                        `;
                    });
                    $('#newsContainer').append(html);


                    //end append data
                }
            });
        }
</script>

<!--content ends-->
<script>
    var currentUrl=window.location.href;
    console.log(currentUrl);
     // Get all the navigation links
    var navLinks = document.querySelectorAll('.nav-btn');
    //  console.log(navLinks[0].href);
    for (var i = 0; i < navLinks.length; i++)
    {
        var link = navLinks[i];
    
        // Compare the link's href with the current URL
        if (link.href === currentUrl)
        {
            // Add the "active" class to the parent li element
            link.parentNode.classList.add('text-red-600');
        }
    }
</script>
<?php include 'includes/footer.php';?>

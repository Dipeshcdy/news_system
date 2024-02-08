<?php 
include 'includes/header.php';
?>
<?php
$id = $_GET['id'];
$qry = "select * from news where id='".$id."'";
$commentQry="select id,username,comment,created_at from comments where news_id='".$id."' and is_approve='1' order by created_at desc";
include 'includes/db_connect.php';
$result = $con->query($qry)->fetch_assoc();
$resultComment= $con->query($commentQry);
include 'includes/db_close.php';
?>

<!-- content -->
<section>
    <div class="xl:ml-64 px-10 lg:px-0 lg:pl-12 mt-28">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">
            <div class="lg:col-span-3 order-1 ">
                <h1 class="text-4xl pb-4 font-bold">
                    <?php echo $result['title'] ;?>
                </h1>
                <hr class="w-[10%] bg-black h-0.5" />
                <div class="mt-4">
                    <img src="Images/news/<?php echo $result['image'] ;?>"
                        alt="" />
                </div>
            </div>
            <div class="lg:col-span-1 order-last lg:order-2 md:px-4">
                <div class="flex mt-3">
                    <h2 class="bg-red-500 px-4 py-0.5 rounded-lg text-lg text-white">
                        Recent News
                    </h2>
                </div>
                <div>
                    <div class="h-96 overflow-hidden mt-5">
                        <div class="marquee">
                            <!-- element to be in loop -->
                            <?php 
                            if(isset($recentNewsRows))
                            {
                                foreach ($recentNewsRows as $row )
                                {
                            ?>
                                    <div class="cursor-default font-semibold mt-4 pb-4 border-b border-gray-700 border-opacity-50">
                                        <div class="grid grid-cols-3 gap-4">
                                            <div class="col-span-2">
                                                <span class="text-gray-400 text-xs">
                                                    <?php
                                                    $timeAgo=timeCalculate($row['created_at']);
                                                    echo $timeAgo; 
                                                    ?>
                                                </span>
                                                <h2 class="cursor-pointer text-sm hover:text-blue-500">
                                                    <a href="content.php?id=<?php echo $row['id'] ?>">
                                                        <?php echo $row['title'] ?>
                                                    </a>
                                                </h2>
                                            </div>
                                            <div class="lg:mt-10">
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
                            <!-- end of element to be in loop -->
                        </div>
                    </div>
                    

                </div>
            </div>
            <div class="lg:col-span-3 order-3 lg:order-2">
                <!-- description -->
                <div class="text-lg text-justify">
                    <?php echo $result['description'] ;?>
                </div>
                <!-- description ends -->
                <div class="my-8">
                     <h1 class="text-xl font-bold">Write your comment...</h1>
                     <div>
                        <form action="comment_post.php" method="POST">   
                        <input type="hidden" name="news_id" value="<?php echo $result['id']; ?>">
                            <div>
                                <div class="grid grid-cols-2 gap-5 mt-4">
                                    <div class="my-2 relative form-group mt-3">
                                        <input type="text" name="username" id="username"  class="form-control w-full rounded-md h-11 mt-1 border-2 border-gray-400  px-1  outline-none" value="<?php echo isset($_SESSION['old_data']['username']) ? $_SESSION['old_data']['username'] : ''; ?>">
                                        <label for="username" class="form-label bg-white text-lg font-semibold">Name</label>
                                        <?php if(isset($_SESSION['errors']['username'])): ?>
                                            <span class="error block text-red-600"><?php echo $_SESSION['errors']['username'].'*'; ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="my-2 relative form-group mt-3">
                                        <input type="text" name="email" id="email"  class="form-control w-full rounded-md h-11 mt-1 border-2 border-gray-400  px-1  outline-none" value="<?php echo isset($_SESSION['old_data']['email']) ? $_SESSION['old_data']['email'] : ''; ?>">
                                        <label for="email" class="form-label bg-white text-lg font-semibold">Email</label>
                                        <?php if(isset($_SESSION['errors']['email'])): ?>
                                            <span class="error block text-red-600"><?php echo $_SESSION['errors']['email'].'*'; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="my-2 relative form-group mt-3">
                                    <textarea name="comment" id="comment" cols="30" rows="10" class="form-control w-full rounded-md mt-1 pt-2 border-2 border-gray-400 px-1  outline-none" ><?php echo isset($_SESSION['old_data']['comment']) ? $_SESSION['old_data']['comment']:''; ?></textarea>
                                        <label for="comment" class="form-label bg-white text-lg font-semibold">Comment</label>
                                        <?php if(isset($_SESSION['errors']['comment'])): ?>
                                            <span class="error block text-red-600"><?php echo $_SESSION['errors']['comment'].'*'; ?></span>
                                        <?php endif; ?>
                                </div>
                            </div>
                           <button type="submit" name="news_comment" class="px-4 py-2 text-lg font-semibold bg-blue-600 hover:border shadow hover:border-blue-600 hover:text-blue-600 hover:bg-transparent text-white rounded-lg mt-5">Post Comment</button>
                        </form>
                     </div>
                </div>
            </div>

            <div class="lg:col-span-1 order-4  xl:mt-0 md:px-4">
                <div class="flex mt-1">
                    <h2 class="text-center w-full text-xl font-bold py-2 border-t-4 border-b-2 border-black">
                    Recent Comments
                    </h2>
                </div>
                <div>
                    <div class="h-96 overflow-y-auto">
                        <div class="">
                            <!-- element to be in loop -->
                            <?php 
                            if(isset($resultComment))
                            {
                                foreach ($resultComment as $row )
                                {
                            ?>
                                    <div class="cursor-default font-semibold mt-4 pb-4 border-b border-gray-700 border-opacity-50">
                                        <div>
                                            <span class="text-gray-400 text-xs">
                                                <?php
                                                    $timeAgo=timeCalculate($row['created_at']);
                                                    echo $timeAgo; 
                                                ?>
                                            </span>
                                            <h2 class="cursor-pointer text-lg hover:text-blue-500">
                                                    <?php echo $row['username']; ?>
                                            </h2>
                                            <p class="font-normal text-xs">
                                                    <?php echo $row['comment']; ?>
                                            </p>
                                        </div>
                                    </div>
                            <?php
                            }
                            }   
                            ?>
                        </div>
                        <?php

                            if ($resultComment->num_rows==0)
                            {
                        ?>

                                <div class="cursor-default font-semibold mt-4 pb-4 border-b border-gray-700 border-opacity-50">
                                    <p class="text-red-600 hover:text-red-800 cursor-pointer text-center">No any comments here!</p>
                                </div>
                        <?php 
                            }
                        ?>
                            <!-- end of element to be in loop -->
                    </div>
                    

                </div>
            </div>
        </div>    
    </div>
</section>
<script>
    $(document).ready(function(){
    $(".form-group .form-control").each(function() {
        if ($(this).val() !== "") {
            $(this).siblings("label").addClass("active");
        }
    });
    $(".form-group .form-control").blur(function(){
        if($(this).val()!=""){
            $(this).siblings("label").addClass("active");
        }else{

            $(this).siblings("label").removeClass("active");

        }
    });

    });
</script>
<!-- content ends -->
<?php
    if(isset($_SESSION['errors']))
    {

        unset($_SESSION['errors']);
    }
    if(isset($_SESSION['old_data']))
    {

        unset($_SESSION['old_data']);
    }

    session_write_close();
?>
<script src="includes/sessionRemoveScript.js"></script>

<?php include 'includes/footer.php';?>
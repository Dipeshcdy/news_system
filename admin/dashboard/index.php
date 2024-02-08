 <?php
  include '../admin_nav.php';
  ?>


 <?php

    include '../../includes/db_connect.php';
    $qry = "
    SELECT 'news' as table_name, COUNT(*) as count FROM news UNION
    SELECT 'categories' as table_name, COUNT(*) as count FROM categories UNION
    SELECT 'comments' as table_name, COUNT(*) as count FROM comments where is_approve='0' UNION
    SELECT 'editors' as table_name, COUNT(*) as count FROM editors
    ";
    $result = $con->query($qry);
    include '../../includes/db_close.php';


 ?>

 <div class="lg:py-20 mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[14%] mr-[5%]"
     id="mainarea">
     <h1 class="text-xl font-bold text-[#061638]">Dashboard</h1>
     <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />
     
     <div class="grid grid-cols-2 gap-5">
        <?php

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                
                ?>
                <div class="bg-[#F9F5F6] px-20 py-10 drop-shadow-lg rounded-tl-3xl rounded-br-3xl">
                    <h1 class="cursor-pointer text-blue-600 text-center uppercase hover:text-blue-800 font-bold font-sans text-2xl"><a href="
                    <?php
                        if ($row['table_name'] == "news") 
                        {
                            echo "http://localhost/newssite/admin/news/";
                        } 
                        else if ($row['table_name'] == "categories") 
                        {
                            if (isset($_SESSION['isEditor']) == false) {
                                echo "http://localhost/newssite/admin/category/";
                            }
                        } 
                        else if ($row['table_name'] == "comments") 
                        {
                            if (isset($_SESSION['isEditor']) == false) {
                                echo "http://localhost/newssite/admin/comments/pending.php";
                            }
                        } 
                        else if ($row['table_name'] == "editors") 
                        {
                            if (isset($_SESSION['isEditor']) == false) {
                                echo "http://localhost/newssite/admin/editor/";
                            }
                        }
                    
                    ?>">Total <span class="uppercase"><?php echo $row['table_name'] ;?></span></a></h1>
                    <p class="cursor-pointer text-center text-4xl font-bold text-gray-950 hover:text-gray-500"><?php echo $row['count'];?></p>
                </div>
                

                <?php
            }
        }

        ?>
    </div>

    <div class="bg-[#f7f3f3] px-10 py-10 mt-10 drop-shadow-xl rounded-tl-3xl rounded-br-3xl">
        <h1 class="text-center text-xl font-semibold">!! Welcome <span class="text-blue-600 hover:text-blue-800"><?php echo $_SESSION['username'] ?></span> in this Portal, Feel free to manage your task. !!</h1>
    </div>
 </div>


 <?php include '../admin_footer.php';?>
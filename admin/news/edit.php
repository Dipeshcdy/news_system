<?php include '../admin_nav.php';?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $qry = "select * from news where id='".$id."'";
    $cat_qry= "select * from categories";
    include '../../includes/db_connect.php';
    $result = $con->query($qry);
    $categories = $con->query($cat_qry);
    include '../../includes/db_close.php';
      if ($result->num_rows > 0) {        
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $desc = $row['description'];
            $image = $row['image'];
            $cat_id = $row['cat_id'];

        } 
}


?>

<div class="lg:py-6  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[14%] mr-[5%]"
    id="mainarea">
    <h1 class="text-xl font-bold text-[#061638] pt-12">Update News</h1>
    <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />

    <div class="w-[96%] border mx-12 shadow bg-[#F9F5F6] rounded-xl">
        <div class="px-10 py-10">
            <form action="news_action.php" class="w-full" method="POST" enctype="multipart/form-data">
                <div class="my-2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div>
                        <label for="title" class="text-black text-lg font-bold">Title</label>
                        <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2" id="title" name="title" value="<?php echo $title; ?>">
                        <?php if (isset($_SESSION['errors']['title'])): ?>
                        <span class="error block text-red-600"><?php echo $_SESSION['errors']['title'].'*'; ?></span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for=" desc" class="text-black text-lg font-bold">Description</label>
                        <textarea type="text" class="border outline-none  shadow py-2 px-4 block w-full rounded-xl my-2" id="desc" name="desc"><?php echo $desc; ?></textarea>
                        <?php if (isset($_SESSION['errors']['desc'])): ?>
                        <span class="error block text-red-600"><?php echo $_SESSION['errors']['desc'].'*'; ?></span>
                        <?php endif; ?>
                    </div>
                    <label for="c_image" class="text-black text-lg font-bold">Current Image</label>
                    <div class="my-5">
                        <img src="../../Images/news/<?php echo $image ?>">
                    </div>
                    <div>
                        <label for="image" class="text-black text-lg font-bold">Choose New Image</label>
                        <input type="file" class="border outline-none  shadow py-2 px-4 block w-full rounded-xl my-2" id="image" name="image">
                    </div>
                    <div>
                        <label for=" category" class="text-black text-lg font-bold">Category</label>
                        <select required type="text"
                            class="border outline-none  shadow py-2 px-4 block w-full rounded-xl my-2" id="category"
                            name="category">
                            <?php
                            if ($categories->num_rows > 0) {
                            while ($row = $categories->fetch_assoc()) {
                            ?>
                            <option value=" <?php echo $row['id'] ?>" <?php echo ($row['id']==$cat_id?'selected':'') ?>>
                                <?php echo $row['cat_name'] ?>
                            </option>
                            <?php
                        }
                        }
                        else{
                            ?>
                            <option value="" disabled>--Add Category first--</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class=" my-4">
                    <input type="submit" name="update" value="Update" class=" rounded cursor-pointer text-white px-4 py-2 bg-blue-600 hover:bg-blue-800 text-md font-semibold">
                    <a class="rounded bg-red-600 hover:bg-red-800 text-white px-4 py-2 text-md font-semibold" href="index.php">
                        Exit
                    </a>
                </div>

            </form>
        </div>

    </div>

</div>

<?php
}
 else {
    header("Location: index.php");
 }

?>
<script>
tinymce.init({
    selector: 'textarea#desc'
});
</script>
<?php
// session_start();
if(isset($_SESSION['errors']))
{

    unset($_SESSION['errors']);
    // unset($_SESSION['old_data']);
}
// session_abort();
session_write_close();

?>






<?php include '../admin_footer.php';?>
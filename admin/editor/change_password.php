<?php include '../admin_nav.php';?>

<?php
session_start();

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $qry = "select * from editors where id='".$id."'";
    include '../../includes/db_connect.php';
    $result = $con->query($qry);
    include '../../includes/db_close.php';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
        }
    }
}

?>


<div class="lg:py-6  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[14%] mr-[5%]"
    id="mainarea">
    <h1 class="text-xl font-bold text-[#061638]">Change Editor Password</h1>
    <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />

    <div class="w-[96%] border mx-12 shadow bg-[#F9F5F6] rounded-xl">
        <div class="px-10 py-10">
            <form action="change_pass.php" class="w-full" method="POST">
                <div class="my-2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <label for="username" class="text-black text-xl font-bold">New Password</label>
                    <input type="password" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2"
                        id="new_password" name="new_password" value="<?php echo isset($_SESSION['old_data']['new_password']) ? $_SESSION['old_data']['new_password'] : ''; ?>">
                    <?php if (isset($_SESSION['errors']['new_password'])): ?>
                        <span class="block text-red-600"><?php echo $_SESSION['errors']['new_password'].'*'; ?></span>
                    <?php endif; ?>   
                </div>

                <div class="my-2">
                    <label for="confirm_password" class="text-black text-xl font-bold">Confirm Password</label>
                    <input type="password" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2"
                        id="confirm_password" name="confirm_password" value="<?php echo isset($_SESSION['old_data']['confirm_password']) ? $_SESSION['old_data']['confirm_password'] : ''; ?>">
                </div>

                <div class="my-4">
                    <input type="submit" name="pass_change" value="Update"
                        class="rounded cursor-pointer text-white px-4 py-2 bg-blue-600 hover:bg-blue-800 text-md font-semibold">
                    
                    <a class="rounded bg-red-600 hover:bg-red-800 text-white px-4 py-2 text-md font-semibold" href="index.php">Exit</a>
                </div>

            </form>
        </div>

    </div>

</div>

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


<?php include '../admin_footer.php';?>
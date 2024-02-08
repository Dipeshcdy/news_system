<?php include '../admin_nav.php';
session_start();
?>


<div class="lg:py-6  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[14%] mr-[5%]"
    id="mainarea">
    <h1 class="text-xl font-bold text-[#061638]">Asign Editor</h1>
    <hr class="my-4 bg-[#061638] border-2 border-[#061638]" />

    <div class="w-[96%] border mx-12 shadow bg-[#F9F5F6] rounded-xl">
        <div class="px-10 py-10">
            <form action="editor_action.php" class="w-full" method="POST">
                <div class="my-2">
                    <label for="username" class="text-black text-xl font-bold">User Name</label>
                    <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2"
                        id="username" name="username" value="<?php echo isset($_SESSION['old_data']['username']) ? $_SESSION['old_data']['username'] : ''; ?>">
                    <?php if (isset($_SESSION['errors']['username'])): ?>
                        <span class="block text-red-600"><?php echo $_SESSION['errors']['username'].'*'; ?></span>
                    <?php endif; ?>   
                </div>

                <div class="my-2">
                    <label for="Email" class="text-black text-xl font-bold">Email</label>
                    <input type="text" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2"
                        id="email" name="email" value="<?php echo isset($_SESSION['old_data']['email']) ? $_SESSION['old_data']['email'] : ''; ?>">
                    <?php if (isset($_SESSION['errors']['email'])): ?>
                        <span class="block text-red-600"><?php echo $_SESSION['errors']['email'].'*'; ?></span>
                    <?php endif; ?>    
                </div>

                <div class="my-2">
                    <label for="password" class="text-black text-xl font-bold">Password</label>
                    <input type="password" class="border-none outline-none shadow py-2 px-4 block w-full rounded-xl my-2"
                        id="password" name="password" value="<?php echo isset($_SESSION['old_data']['password']) ? $_SESSION['old_data']['password'] : ''; ?>">
                    <?php if (isset($_SESSION['errors']['password'])): ?>
                        <span class="block text-red-600"><?php echo $_SESSION['errors']['password'].'*'; ?></span>
                    <?php endif; ?>
                </div>

                <div class="my-4">
                    <input type="submit" name="add" value="Assign"
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
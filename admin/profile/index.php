<?php 
include '../admin_nav.php' 
?>


<div class="lg:py-20  mt-7 lg:mt-0 transition-all duration-1000 ease  text-center md:text-left ml-[14%] mr-[7%]" id="mainarea">
    <div class="px-10 py-10 border bg-[#F9F5F6] text-black shadow-lg rounded">
        <h1 class="text-xl font-bold">Your Info!</h1>

        <div class="grid grid-cols-2 gap-5">
            <div>
                <div class="bg-[#F9F5F6] shadow my-4">
                    <label for="" class="px-4 py-2 text-lg font-semibold">User Name</label>
                    <input type="text" class="bg-[#F9F5F6] text-lg font-semibold px-4 py-2 " value="<?php echo $_SESSION['username']; ?>" disabled>
                </div>
                <div class="bg-[#F9F5F6] shadow my-4">
                    <label for="" class="px-4 py-2 text-lg font-semibold">User Email</label>
                    <input type="text" class="bg-[#F9F5F6] px-4 py-2 text-lg font-semibold" value="<?php echo $_SESSION['email']; ?>" disabled>
                </div>
            </div>

            <div class="px-10 py-5">
                <img src="../../Images/welcome.png" alt="" class="w-[70%] h-full">
                <span class="px-10 inline-block text-4xl uppercase font-bold font-sans"><?php echo $_SESSION['username'];?></span>
            </div>
        </div>

        <div class="my-4">
            <h1 class="text-lg font-semibold font-sans text-blue-400">If you want to change your password click below button <i class="fas fa-arrow-to-bottom"></i></h1>
            <div class="mt-4">
                <a href="update_pass.php?id=<?php echo $_SESSION['id'];?>" class="bg-blue-600 hover:bg-blue-800 font-sans text-white px-4 py-2 text-md font-semibold my-2 rounded">Change Password</a>
            </div>
        </div>
    </div>
</div>














<?php include '../admin_footer.php' ?>
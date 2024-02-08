<?php
include 'includes/header.php';
?>

<section class="mt-24 xl:px-36">
    <div class=" mx-52 py-2.5  mt-5">
        <h2 class="text-3xl mb-5 font-bold">
            Contact Us
        </h2>
        <form action="messagePost.php" method="POST" class="">
            <div class="my-2 relative form-group">
                <input  id="name" name="name" type="text" class="form-control w-full rounded-md h-11 mt-1 border-2 border-gray-400  px-1  outline-none" value="<?php echo isset($_SESSION['old_data']['name']) ? $_SESSION['old_data']['name'] : ''; ?>">
                <label for="name"  class="bg-white form-label text-lg font-semibold">Name</label>
                <?php if(isset($_SESSION['errors']['name'])): ?>
                    <span class="error block text-red-600 text-xs"><?php echo $_SESSION['errors']['name'].'*'; ?></span>
                <?php endif; ?>
            </div>
            <div class="my-2 relative form-group mt-3">
                <input  id="email" name="email" type="text" class="form-control w-full rounded-md h-11 mt-1 border-2 border-gray-400  px-1  outline-none" value="<?php echo isset($_SESSION['old_data']['email']) ? $_SESSION['old_data']['email'] : ''; ?>">
                <label for="email"  class="bg-white form-label text-lg font-semibold">Email</label>
                <?php if(isset($_SESSION['errors']['email'])): ?>
                    <span class="error block text-red-600 text-xs"><?php echo $_SESSION['errors']['email'].'*'; ?></span>
                <?php endif; ?>
            </div>
            <div class="my-2 relative form-group mt-3">
                <input  id="contact" name="contact" type="text" class="form-control w-full rounded-md h-11 mt-1 border-2 border-gray-400 px-1  outline-none" value="<?php echo isset($_SESSION['old_data']['contact']) ? $_SESSION['old_data']['contact'] : ''; ?>">
                <label for="contact"  class="bg-white form-label text-lg font-semibold ">Contact</label>
                <?php if(isset($_SESSION['errors']['contact'])): ?>
                    <span class="error block text-red-600 text-xs"><?php echo $_SESSION['errors']['contact'].'*'; ?></span>
                <?php endif; ?>
            </div>
            <div class="my-2 relative form-group mt-3">
                <input  id="address" type="text" name="address" class="form-control w-full rounded-md h-11 mt-1 border-2 border-gray-400 px-1  outline-none" value="<?php echo isset($_SESSION['old_data']['address']) ? $_SESSION['old_data']['address'] : ''; ?>">
                <label for="address"  class="bg-white form-label text-lg font-semibold ">Address</label>
                <?php if(isset($_SESSION['errors']['address'])): ?>
                    <span class="error block text-red-600 text-xs"><?php echo $_SESSION['errors']['address'].'*'; ?></span>
                <?php endif; ?>
            </div>
            <div class="my-2 relative form-group mt-3">
                <textarea cols="30" rows="5"  id="message" type="text" name="message" class="form-control w-full rounded-lg mt-1 border-2 border-gray-400 px-1 pt-3  outline-none"><?php echo isset($_SESSION['old_data']['message']) ? $_SESSION['old_data']['message'] : ''; ?></textarea>
                <label for="message"  class="bg-white form-label text-lg font-semibold ">Message</label>
                <?php if(isset($_SESSION['errors']['message'])): ?>
                    <span class="error block text-red-600 text-xs"><?php echo $_SESSION['errors']['message'].'*'; ?></span>
                <?php endif; ?>
            </div>
            <div class="">
                <button name="messageSubmit" type="submit" class="mx-auto hover:bg-transparent hover:border hover:border-blue-600 hover:text-blue-600 bg-blue-600 text-white px-4 py-2 rounded">
                    Submit
                </button>
            </div>
        </form>
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
<?php
include 'includes/footer.php';
?>
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

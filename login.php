<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- fontawesome cdn  -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="toastify/toastify.css">
    <script src="toastify/toastify.js"></script>
     <!-- custom css -->
     <link rel="stylesheet" href="style.css">
    <script src="tailstyle.js"></script>
</head>

<body>

    <?php
    session_start();
    $passError = "";
    $emailError = "";

    if (isset($_POST['login_submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    if(empty($email) || empty($pass))
    {
        if (empty($email) ) {
            $emailError = "Email is Required";
        }
        if (empty($pass)) {
        $passError = "Password is required";
        } 
    }
    else
    {
        include 'includes/db_connect.php';
        $adminQry = "select * from admins where email = '$email' and password = '$pass'";
        $adminResult = $con->query($adminQry);
        $editorQry = "select * from editors where email = '$email' and password = '$pass'";
        $editorResult = $con->query($editorQry);
    
      if($adminResult->num_rows > 0){
        $admin = $adminResult->fetch_assoc();
        session_start();
        $_SESSION['isAdmin'] = true;
        $_SESSION['id'] = $admin['id'];
        $_SESSION['username'] = $admin['username'];
        $_SESSION['email'] = $admin['email'];
        header("Location: admin");
        exit();
      }
    
      elseif ($editorResult->num_rows > 0) {
        $editor = $editorResult->fetch_assoc();
        session_start();
        $_SESSION['isEditor'] = true;
        $_SESSION['id'] = $editor['id'];
        $_SESSION['username'] = $editor['username'];
        $_SESSION['email'] = $editor['email'];
        $response = [
            'status' => 'success',
            'message' => 'Logged In Successfully',
        ];
        $_SESSION['alert'] = $response;
        header("Location: admin");
        exit();
      }
      else{
        $response = [
            'status' => 'error',
            'message' => 'Your Credentails doesnot match',
        ];
        $_SESSION['alert'] = $response;
      }
    }

 
}

?>


<!-- toast  -->
<section id="toast"  class="toast top-[85px]  shadow-xl text-white">
        <div class="flex px-2  py-2 ">
            <div  class="my-1 mr-3">
                <button id="toastStatus" class=" rounded-full bg-transparent border-2 border-solid">

                </button>
            </div>
            <div>
                <h2 id="toastTitle" class="font-bold "></h2>
                <p id="toastMessage"></p>
            </div>
        </div>
        <div id="toastProgressBar" class="progress-bar"></div>
</section>
    <!-- toast end -->


    <!-- Login page starts  -->

    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
        <div class="flex flex-col bg-white shadow-md px-4 sm:px-6 md:px-8 lg:px-10 py-8 rounded-3xl w-50 max-w-md">
            <div class="font-medium self-center text-xl sm:text-3xl text-gray-800"
                onclick="toastify('login failed','error')">
                Login Here !
            </div>
            <div class="mt-4 self-center text-xl sm:text-sm text-gray-800">
                Enter your login credentials..
            </div>

            <div class="mt-10">
                <form method="post">
                    <div class="flex flex-col mb-5">
                        <label for="email" class="mb-1 text-xs tracking-wide text-gray-600">E-Mail Address:</label>
                        <div class="relative">
                            <div
                                class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                                <i class="fas fa-at text-blue-500"></i>
                            </div>

                            <input id="email" type="text" name="email"
                                class="text-sm placeholder-gray-500 pl-10 pr-4 rounded-2xl border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"
                                placeholder="Enter your email" />
                        </div>
                        <span class="block text-red-600 text-sm px-4"><?php echo $emailError; ?></span>
                    </div>
                    <div class="flex flex-col mb-6">
                        <label for="password"
                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Password:</label>
                        <div class="relative">
                            <div
                                class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                                <span>
                                    <i class="fas fa-lock text-blue-500"></i>
                                </span>
                            </div>

                            <input id="password" type="password" name="password"
                                class="text-sm placeholder-gray-500 pl-10 pr-4 rounded-2xl border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"
                                placeholder="Enter your password" />
                        </div>
                        <span class="block text-red-600 text-sm"><?php echo $passError; ?></span>
                    </div>

                    <div class="flex w-full">
                        <button type="submit"
                            class="flex mt-2 items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-blue-500 hover:bg-blue-600 rounded-2xl py-2 w-full transition duration-150 ease-in"
                            name="login_submit">
                            <span class="mr-2 uppercase">Sign in</span>
                            <span>
                                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- <div class="flex justify-center items-center mt-6">
            <a href="#" target="_blank" class="inline-flex items-center text-gray-700 font-medium text-xs text-center">
                <span class="ml-2">Don't have an account?
                    <a href="register.html" class="text-xs ml-2 text-blue-500 font-semibold">Sign Up Here</a></span>
            </a>
        </div> -->
    </div>

    <!-- Login page ends  -->
</body>

<script>
        <?php
            if (isset($_SESSION['alert']))
            {


                $response = json_encode($_SESSION['alert']);
                echo "
                console.log('hi');
                showToast($response);
                unsetSession();
                
                ";
        
            }
        ?>
        function showToast(response)
        {
            console.log(response.status);
            var toast = document.getElementById('toast');
            var toastStatus = document.getElementById('toastStatus');
            var toastTitle = document.getElementById('toastTitle');
            var toastMessage = document.getElementById('toastMessage');
            var toastProgressBar = document.getElementById('toastProgressBar');
            if(response.status =="success")
            {
                toastStatus.innerHTML='<i class="fas fa-check"></i>';
                toastStatus.classList.add('success');
                toast.classList.add('success');

            }
            else
            {
                toastStatus.innerHTML='<i class="fa fa-times"></i>';
                toastStatus.classList.add('error');
                toast.classList.add('error');

            }
            toastTitle.innerHTML=response.status;
            toastMessage.innerHTML=response.message;
            toast.classList.add('show');

            toastProgressBar.style.width = '100%';
            toastProgressBar.style.width = '0%';

            setTimeout(function()
            {
                toast.classList.remove('show');
            }, 3000);
        }
        function unsetSession()
        {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'unset_session.php', true);
            xhr.send();
        }


    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</html>
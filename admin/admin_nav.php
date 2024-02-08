<?php
session_start();
if (!isset($_SESSION['isAdmin']) && !isset($_SESSION['isEditor'])) {
  header('Location: ../../login.php');
}

// session_write_close();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- sweetalert links  -->
    <link rel="stylesheet" href="../plugins/sweetalert/sweetalert2.min.css">
    <script src="../plugins/sweetalert/sweetalert2.min.js"></script>

    <!-- data table links  -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js"
        integrity="sha512-tofxIFo8lTkPN/ggZgV89daDZkgh1DunsMYBq41usfs3HbxMRVHWFAjSi/MXrT+Vw5XElng9vAfMmOWdLg0YbA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- toast notification  -->
    <link rel="stylesheet" href="../../toastify.css">
    <link rel="stylesheet" href="../../style.css">
    <script src="../../toastify.js"></script>
    
    <script src="../../tailstyle.js"></script>
    <title>Home</title>
    <style>
    .hide {
        display: none !important;

    }
    </style>
</head>

<body>
    <!-- toast  -->
    <section id="toast"  class="toast top-5 z-50  shadow-xl text-white">
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
    <!-- Start of Side Navbar -->

    <div class="bg-[#061638] w-[13%] fixed text-white flex md:block md:px-6 top-0 left-0 bottom-0" id="sidebarnav">
        <div class="mx-auto md:mx-0 flex-col">
            <h1 class="text-xl font-bold ml-2.5">
                <a href="#"><span class="lg:hidden">N</span><span id="NepaNewstitle" class="hidden lg:inline-block">Nepa
                        News</span><span class="text-4xl text-red-600">.</span></a>
            </h1>

            <ul class="pt-10 space-y-4 text-lg" id="menu">
                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]" id="dashboard">
                    <a href="../index.php" class="px-2">
                        <i class="fas fa-home"></i><span class="sidbarNavItemName hidden lg:inline-block ml-1">
                            Dashboard</span></a>
                </li>

                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]" id="news">
                    <a href="../news/" class="px-2">
                        <i class="fas fa-newspaper"></i>
                        <span class="sidbarNavItemName hidden lg:inline-block ml-1">News</span></a>
                </li>

                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]" id="profile">
                    <a href="../profile/" class="px-2">
                        <i class="fas fa-user-lock"></i>
                        <span class="sidbarNavItemName hidden lg:inline-block ml-1">Profile</span>
                    </a>
                </li>

                <?php 

          if (isset($_SESSION['isAdmin'])) {
          ?>

                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]" id="category">
                    <a href="../category/" class="px-2">
                        <i class="fas fa-list"></i>
                        <span class="sidbarNavItemName hidden lg:inline-block ml-1">Category</span>
                    </a>
                </li>

                <li class="dropdown">
                    <button onclick="toggleDropdown()" id="drop-btn" class="hover:text-[#fe5d13] hover:border-l-4 pr-3 hover:border-l-[#fe5d13] pl-2" type="button">
                         <i class="fas fa-comment"></i>
                         <span class="sidbarNavItemName hidden lg:inline-block ml-1 pr-2">Comments</span>
                    </button>
                    <div class="ml-1 hidden" id="dropdown-menu">
                        <div id="pending.php" class="dropdown-item">
                            <a href="../comments/pending.php" class="hover:text-[#fe5d13] ">
                                <i class="far fa-rss"></i>
                                <span class="sidbarNavItemName hidden lg:inline-block ml-1 pr-2">Pending</span>
                            </a>
                        </div>
                        <div id="approve.php" class="dropdown-item">
                            <a href="../comments/approve.php" class=" hover:text-[#fe5d13]">
                                <i class="fas fa-check-double"></i>
                                <span class="sidbarNavItemName hidden lg:inline-block ml-1 pr-2">Approve</span>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]">
                    <a href="../contactUs/" class="px-2">
                        <i class="fas fa-paper-plane"></i>
                        <span class="sidbarNavItemName hidden lg:inline-block ml-1">Contact Us</span></a>
                </li>

                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]" id="editor">
                    <a href="../editor/" class="px-2">
                        <i class="fas fa-user-edit"></i>
                        <span class="sidbarNavItemName hidden lg:inline-block ml-1">Editor</span></a>
                </li>

                <?php
          }
          
          ?>

                <li class="hover:text-[#fe5d13] hover:border-l-4 hover:border-l-[#fe5d13]">
                    <a href="../../logout.php" class="px-2">
                        <i class="fas fa-sign-out"></i>
                        <span class="sidbarNavItemName hidden lg:inline-block ml-1">Log Out</span></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- End of Side Navbar -->

    <!-- Start of Top Navbar -->

    <div class="fixed transparent-all z-30 duration-1000 ease hidden lg:block top-0 right-0 left-[13%] text-xl py-4 px-8 text-[#c4c4c4] bg-white border-b-2 border-b-[#c4c4c4]"
        id="topbarnav">
        <div class="grid grid-cols-2">
            <div>
                <a onclick="sidebarToggle()"><i
                        class="text-left cursor-pointer fas fa-bars hover:text-[#606060]"></i></a>
            </div>
            <div class="space-x-4 text-right">
                <a href="../../logout.php"><i class="far fa-sign-out-alt hover:text-[#606060]"></i></a>     
            </div>
        </div>
    </div>

    <!-- End of Top Navbar -->
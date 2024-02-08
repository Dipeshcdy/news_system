<?php 
session_start();

include 'includes/db_connect.php';
$qry="Select * from categories";
$result=$con->query($qry);
$navRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$recentNewsQuery="select id,title,image,created_at from news ORDER BY created_at DESC ";
$recentNewsResult=$con->query($recentNewsQuery);
$recentNewsRows = mysqli_fetch_all($recentNewsResult, MYSQLI_ASSOC);

include 'includes/db_close.php';
function timeCalculate($created_at)
{
    // Set the time zone to Nepal
    date_default_timezone_set('Asia/Kathmandu');
    // Get the current timestamp
    // $currentDateTime = date('Y-m-d H:i:s');
    $currentTimestamp = date('Y-m-d H:i:s');
    $createdTimestamp=$created_at;

    // Convert the timestamps to DateTime objects
    $createdAtDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $createdTimestamp);
    // $createdAtDateTime = new DateTime("@$createdTimestamp");
    $currentDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $currentTimestamp);
    // die(print_r($createdAtDateTime, true));
    // die(print_r($currentDateTime, true));




    // Calculate the difference between the two timestamps
    $interval = $currentDateTime->diff($createdAtDateTime);
    // die(print_r($interval, true));

    // Determine the appropriate time unit based on the interval
    if ($interval->y >= 1) {
        // If the difference is at least 1 year
        $timeAgo = $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
    } elseif ($interval->m >= 1) {
        // If the difference is at least 1 month
        $timeAgo = $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
    } elseif ($interval->d >= 1) {
        // If the difference is at least 1 day
        $timeAgo = $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
    } elseif ($interval->h >= 1) {
        // If the difference is at least 1 hour
        $timeAgo = $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
    } elseif ($interval->i >= 1) {
        // If the difference is at least 1 minute
        $timeAgo = $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
    } else {
        // If the difference is less than 1 minute
        $timeAgo = "just now";

    }

    return $timeAgo;


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="toastify/toastify.css">
    <!-- custom css -->
    <link rel="stylesheet" href="style.css">
    <!-- fontawesome cdn  -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="toastify/toastify.js"></script>
    <script src="tailstyle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
</head>

<body>

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

    <!-- navigation bar starts  -->
    <section class="bg-[#FFF7D4] lg:px-10 md:px-4 py-5 fixed top-0 left-0 right-0 w-full xl:block hidden z-50">
        <div class="">
            <ul class="flex lg:gap-8 md:gap-4 justify-center">
                <li>
                    <a href="index.php" class="text-xl font-medium text-white bg-blue-700 px-2.5 py-2 rounded-full">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <?php
                if(isset($navRows) && count($navRows)>0)
                {
                    foreach ($navRows as $row) {
                ?>
                        <li>
                            <a href="categoryTemplate.php?id=<?php echo $row['id'] ?>" id="nav<?php echo $row['id'] ?>" class="text-xl hover:text-red-600 nav-btn font-medium">
                                <?php echo $row['cat_name'] ?>
                            </a>
                        </li>
                <?php
                    }
                }
                ?>
                <li>
                    <a href="contactUs.php" class="text-xl hover:text-red-600 nav-btn font-medium">
                        Contact Us
                    </a>
                </li>
               
                <li>
                    <form class="flex items-center" method="POST" action="index.php">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" id="search"
                                class=" border border-gray-900 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 "
                                placeholder="Search" name="query" required>
                        </div>
                        <button type="submit"
                            class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </section>
    <!-- navigation bar ends  -->

    <!-- mobile navbar starts  -->
    <section class="fixed bg-[#FFF7D4] top-0 left-0 right-0 text-black px-10 py-5 w-full shadow z-20 xl:hidden">
        <div class="flex justify-between">
            <h1 class="text-xl font-bold">Nepa News</h1>
            <div onclick="mobNav()" class="cursor-pointer">
                <i class="fas fa-bars text-xl font-bold hover:text-blue-600" id="mobopen"></i>
                <i class="fal fa-times text-xl font-bold text-red-600" id="mobclose"></i>
            </div>
        </div>
    </section>
    <div class="fixed z-50 w-[50%] top-[4rem] bottom-0 left-0 ml-[-120%] right-0 xl:hidden" id="navMobile">
        <div class="mt-10 mx-5">
            <form class="flex items-center" method="POST" action="index.php">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="simple-search"
                        class=" border border-gray-900 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 "
                        placeholder="Search" name="query" required>
                </div>
                <button type="submit"
                    class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>
        <ul class="absolute left-1/2 transform -translate-x-1/2">

            <li class="my-6">
                <a href="index.php" class="py-2 rounded-xl text-xl font-medium text-black">Home</a>
            </li>
            <?php
                if(isset($navRows) && count($navRows)>0)
                {
                    foreach ($navRows as $row)
                    {
            ?>
                        <li class="my-6">
                            <a href="categoryTemplate.php?id=<?php echo $row['id'] ?>" class="py-2 rounded-xl text-xl font-medium text-black">
                                <?php echo $row['cat_name'] ?>
                            </a>
                        </li> 
            <?php
                    }
                }
            ?>
            <li class="my-6">
                <a href="contactUs.php" class="py-2 rounded-xl text-xl font-medium text-black">Contact Us</a>
            </li>
        </ul>
    </div>
    <!-- mobile navbar ends  -->
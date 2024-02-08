    <!-- navbar script  -->
    <script>
        let nav = document.getElementById("navMobile");
        let close = document.getElementById("mobclose");
        let open = document.getElementById("mobopen");
        nav.style.marginLeft = "-120%";
        close.style.display = "none";

        function mobNav()
        {
            if (nav.style.marginLeft == "-120%") {
                nav.style.marginLeft = "0";
                close.style.display = "block";
                open.style.display = "none";
                nav.style.transition = "0.8s";
                nav.style.backgroundColor = "#FCE9F1";
            } else {
                close.style.display = "none";
                nav.style.backgroundColor = "white";
                open.style.display = "block";
                nav.style.marginLeft = "-120%";
                nav.style.transition = "0.8s";
            }
        }
    </script>
    <!-- navbar script ends  -->

    <!-- footer section starts  -->
    <div class="lg:px-36 py-10 md:px-10 px-4 mt-80 shadow-lg bg-[#F9F5F6]">
        <div class="grid md:grid-cols-3 grid-cols-1 gap-5">
            <div class=" px-10">
                <div class="text-center">
                    <img src="logo/logo.svg" alt="" class="text-white w-[60%]" />
                    <p class="text-justify text-lg my-4">
                        This is authorized news portal of Nepal News Daily. This nepali news
                        portal includes news, opinions, entertainment, sports, world,
                        information & technology, video as well as various lifestyle
                        articles.
                    </p>
                </div>
                
            </div>

            <div class="px-10">
                <h1 class="text-2xl font-bold">Useful Links</h1>

                <ul class="px-4 my-4">
                    <li class="text-lg hover:underline hover:text-red-600">
                        <a href="index.php">Home</a>
                    </li>
                    <?php
                    if(isset($navRows) && count($navRows)>0)
                    {
                        foreach ($navRows as $row) {
                    ?>
                        <li class="text-lg hover:underline hover:text-red-600">
                            <a href="categoryTemplate.php?id=<?php echo $row['id'] ?>"><?php echo $row['cat_name'] ?></a>
                        </li>
                    <?php
                        }
                    }
                    ?>
                    
                </ul>
            </div>

            <div class="px-10">
                <h1 class="text-2xl font-bold">Contact Address</h1>
                <div class="px-2 my-4">
                    <p class="text-lg">NepaNews Publication Pvt.Ltd</p>
                    <p class="text-lg">Ratnanager-02, Tandi</p>
                    <p class="text-lg">Chitwan, Nepal</p>
                </div>

                <div class="px-2">
                    <p class="text-lg">contact: +977–01–4445751</p>
                    <p class="text-lg">Email : info@nepanews.com</p>
                </div>

                <div class="my-2">
                    <h1 class="text-xl font-bold">Social Media</h1>
                    <div class="my-2">
                        <a href=""><i class="fab fa-facebook text-2xl mx-4"></i></a>
                        <a href=""><i class="fab fa-instagram text-2xl mx-4"></i></a>
                        <a href=""><i class="fab fa-twitter text-2xl mx-4"></i></a>
                        <a href=""><i class="fab fa-youtube text-2xl mx-4"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:flex mt-5 md:-mt-10 md:px-10">
            <h2 class="font-bold text-lg text-center md:text-left">Powered By:- </h2>
            <h2 class="ml-5 text-center mt-1 font-semibold md:-mt-2 border-y-2  border-[#be09ac] px-5">Dipesh Chaudhary <br>Jeshan Tiwari</h2>
        </div>
    </div>

    <!-- footer section ends  -->
</body>
    <script>
        <?php
            if (isset($_SESSION['alert']))
            {
                $response = json_encode($_SESSION['alert']);
                echo "
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
    <script>
        // Add event listener to input field
        document.getElementByClass('inputField').addEventListener('focus', function() {
        this.previousElementSibling.classList.add('translate-y-[-80%] text-xs');
        });

        document.getElementById('inputField').addEventListener('blur', function() {
        if (this.value === '') {
            this.previousElementSibling.classList.remove('translate-y-[-80%] text-xs');
        }
        });

    </script>
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</html>
    

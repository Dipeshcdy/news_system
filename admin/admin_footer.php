     <!-- Start OF Custom Scripts -->

<script>
var sidebarnav = document.getElementById("sidebarnav");
var spans = document.querySelectorAll(".sidbarNavItemName");
var topbarnav = document.getElementById("topbarnav");
var mainarea = document.getElementById("mainarea");
var title = document.getElementById("NepaNewstitle");

function sidebarToggle() {
    if (sidebarnav.style.width != "7%") {
        sidebarnav.style.width = "7%";
        sidebarnav.style.transition = "1s ease";
        topbarnav.style.left = "7%";
        topbarnav.style.transition = "1s ease";
        mainarea.style.marginLeft = "8%";
        mainarea.style.transition = "1s ease";
        setTimeout(function() {
            title.innerHTML = "N";
            spanHide();
        }, 50);
    } else {
        sidebarnav.style.width = "13%";
        sidebarnav.style.transition = "1s ease";
        topbarnav.style.left = "13%";
        topbarnav.style.transition = "1s ease";
        mainarea.style.marginLeft = "14%";
        mainarea.style.transition = "1s ease";
        setTimeout(function() {
            title.innerHTML = "Nepa News";
            spanHide();
        }, 800);
    }
}

function spanHide() {
    spans.forEach(function(span) {
        // Perform your action on each element here
        // For example:
        span.classList.toggle("lg:inline-block");
    });
}

</script>

<!-- toast script -->
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
        xhr.open('GET', '../../unset_session.php', true);
        xhr.send();
    }
</script>
<!-- end of toast script -->

   
<script>

    $(document).ready(function () {
        $('#mytable').DataTable();
        
    });
   
</script>


<script>

    let table = new DataTable('#myTable', {
        responsive:true,
    });

</script>

<script>
    
// jQuery code for dropdown menu but not worked well.
// $(document).ready(function() {
//   $('.dropdown-toggle').on('click', function(event) {
//     event.preventDefault(); // Prevent the default behavior of the button click
//     $(this).next('.dropdown-menu').slideToggle(200);
//   });

//   $('.dropdown-item').on('click', function() {
//     var selectedOption = $(this).text();
//     $('.dropdown-toggle').text(selectedOption);
//     $('.dropdown-menu').slideUp(200);
//   });
// });


// vanila javascript code for dropdown-menu worked well
function toggleDropdown() {
  var dropdownMenu = document.getElementById("dropdown-menu");
  dropdownMenu.style.display = (dropdownMenu.style.display === "block") ? "none" : "block";
}

// Restore dropdown state on page load
window.addEventListener("load", function() {
  var dropdownMenu = document.getElementById("dropdown-menu");
  dropdownMenu.style.display = "none";
});

</script>

<script>
    
document.addEventListener("DOMContentLoaded", function() {
  var path = window.location.pathname;
  var segments = path.split("/").filter(segment => segment !== "");
  var currentPath = segments[segments.length - 1];
    // console.log(currentPath);

   if (currentPath == "dashboard") {
    document.getElementById("dashboard").classList.add("text-blue-800");
    document.getElementById("dashboard").classList.add("bg-[#ffffff]");
    document.getElementById("dashboard").classList.add("rounded-r-xl");
    document.getElementById("dashboard").classList.add("font-bold");
   }
   if (currentPath == "news") {
    document.getElementById("news").classList.add("text-blue-800");
    document.getElementById("news").classList.add("bg-[#ffffff]");
    document.getElementById("news").classList.add("rounded-r-xl");
    document.getElementById("news").classList.add("font-bold");
   }
   if (currentPath == "category") {
    document.getElementById("category").classList.add("text-blue-800");
    document.getElementById("category").classList.add("bg-[#ffffff]");
    document.getElementById("category").classList.add("rounded-r-xl");
    document.getElementById("category").classList.add("font-bold");
   }
   if (currentPath == "profile") {
    document.getElementById("profile").classList.add("text-blue-800");
    document.getElementById("profile").classList.add("bg-[#ffffff]");
    document.getElementById("profile").classList.add("rounded-r-xl");
    document.getElementById("profile").classList.add("font-bold");
   }
   if (currentPath == "editor") {
    document.getElementById("editor").classList.add("text-blue-800");
    document.getElementById("editor").classList.add("bg-[#ffffff]");
    document.getElementById("editor").classList.add("rounded-r-xl");
    document.getElementById("editor").classList.add("font-bold");
   }

   if (currentPath == "pending.php" || currentPath== "approve.php") {
    document.getElementById("drop-btn").classList.add("text-blue-800");
    document.getElementById("drop-btn").classList.add("bg-[#ffffff]");
    document.getElementById("drop-btn").classList.add("rounded-r-xl");
    document.getElementById("drop-btn").classList.add("font-bold");
   }

});

</script>

     <!-- End OF Custom Scripts -->
</body>

</html>
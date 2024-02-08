
function toastify(message,type) {
  var m = document.getElementById("message");
  var i = document.getElementById("toastIcon");
  var x = document.getElementById("toast");
  // console.log(m);
    if (type=="success") {
        i.className = "text-green-400 fas fa-check-circle";
    }

    else if(type == "error") {
        i.className = "text-red-600 fas fa-times-circle";
    }

    else{
        i.className = "text-yellow-400 fas fa-exclamation-circle";
    }

    m.innerHTML = message;
    
  // Add the "show" class to DIV
  x.className = "show";

  // After 3 seconds, remove the show class from DIV
  setTimeout(function () {
    x.className = x.className.replace("show", "");
  }, 3000);
}

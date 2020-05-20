navLogInButton = document.querySelector("#submit");
popup = document.querySelector(".fade-background");
dropdown = document.querySelectorAll(".dropdown");
dropdownList = document.querySelectorAll(".dropdown .dropdown-menu li");

// page elements
var navbar = document.getElementById("navbar");
var header = document.querySelector("main");

// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 48 || document.documentElement.scrollTop > 48) {
    // Scrolled position
    navbar.style.padding = "12px 48px 12px";
    navbar.style.background = "#321575";
  } else {
    navbar.style.background = "transparent";
    navbar.style.padding = "40px 128px 12px";
  }
} 

function initHeaderMargin() {
   header.style.marginTop = navbar.offsetHeight + "px";
}

initHeaderMargin();

window.addEventListener("click", (e) => {
  if (e.target == navLogInButton) {
    popup.style.display = "flex";
  }

  if (e.target == popup) {
    popup.style.display = "none";
  }
});

dropdown.forEach((currentDropdown) => {
  currentDropdown.addEventListener("click", function (e) {
    this.focus();
    this.classList.toggle("active");
    this.querySelector(".dropdown-menu").classList.toggle("slideToggle");
  });

  currentDropdown.addEventListener("focusout", function (e) {
    this.classList.remove("active");
    this.querySelector(".dropdown-menu").classList.remove("slideToggle");
  });
});

dropdownList.forEach((currentList) => {
  currentList.addEventListener("click", function (e) {
    currentList.parentNode.parentNode.querySelector(".dropdown-label").classList.add("activated");
    currentList.parentNode.parentNode.querySelector("span").innerText = this.innerText;
    currentList.parentNode.parentNode.querySelector("span").style.display = "inline";
    currentList.parentNode.parentNode.querySelector("input").setAttribute("value", this.innerText);
    currentList.parentNode.parentNode.style.cssText = "color:black;font-weight:bold";
  });
});

document.querySelector("#add-complaint").addEventListener("click", function (e) {
 idCollege=document.querySelector(".CollegeName").getAttribute("value");
 idProblem=document.querySelector(".CollegeProblem").getAttribute("value");
 idProblemDetails=document.querySelector(".ProblemDetails").value;
 idProblemLocation=document.querySelector(".ProblemLocation").value;
 idfileUpload=document.querySelector(".fileUpload").value;
 console.log(document.querySelector(".CollegeName").getAttribute("value"));
 console.log(document.querySelector(".CollegeProblem").getAttribute("value"));
 console.log(document.querySelector(".ProblemDetails").value);
 console.log(document.querySelector(".ProblemLocation").value);
 console.log(document.querySelector(".fileUpload").value);
});

function validateForm() {
  var x = document.forms["reportForm"][".CollegeName"].value;
  var y=document.forms["reportForm"][".CollegeProblem"].value;
  var z=document.forms["reportForm"][".ProblemDetails"].value;
  var m=document.forms["reportForm"][".ProblemLocation"].value;
  if (x == "") {
    // alert("Residential College must be filled out");
    return false;
  }
  if (y == "") {
    // alert("College Problem must be filled out");
    return false;
  }
  if (z == "") {
    // alert("Problem Details must be filled out");
    return false;
  }
  if (m == "") {
    // alert("Problem Location must be filled out");
    return false;
  }
  return true;
  }


var table

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var submitBtn = document.getElementById("submit");

// Get the <span> element that closes the modal
var spant = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
submitBtn.onclick = function() {
  if (validateForm()== true){
    modal.style.display = "block";
  }
}

// When the user clicks on <span> (x), close the modal
spant.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  else if (event.target ==comModal)
  {
    comModal.style.display = "none";
  }
}

var comModal = document.getElementById("complainModal");

// Get the button that opens the modal
var recordBtn = document.getElementById("record");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("clase")[0];

// When the user clicks on the button, open the modal
recordBtn.onclick = function() {
  comModal.style.display = "block";
}

span.onclick = function() {
  comModal.style.display = "none";
}

function insertData() {
  $("#TableBody").append(
    "<tr><td>" +
      $(".CollegeName").val() +
      "</td><td>" +
      $(".CollegeProblem").val() +
      "</td><td>" +
      $(".ProblemDetails").val() +
      "</td><td>" +
      $(".ProblemLocation").val() +
      "</td><td>" +
      $(".fileUpload").val() +
      "</td></tr>"
  );
}




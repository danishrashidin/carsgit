function openFolder(status) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(status).style.display = "block";
    evt.currentTarget.className += " active";
  }

document.querySelector(".AllTransactions").addEventListener("click", function (e) { 
console.log(e.target);
openFolder('AllTransactions')});
document.querySelector(".Pending").addEventListener("click", function(e) {openFolder('Pending')});
document.querySelector(".Completed").addEventListener("click", function(e) { openFolder('Completed')});
document.querySelector(".InProgress").addEventListener("click", function(e) { openFolder('InProgress')});

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
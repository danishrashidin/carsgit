// Homepage elements
var navbar = document.getElementById("navbar");
var main = document.querySelector("main");

// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 48 || document.documentElement.scrollTop > 48) {
    // Scrolled position
    navbar.style.padding = "12px 48px 12px";
    navbar.style.background = "#321575";
  } else {
    navbar.style.background = "grey";
    navbar.style.padding = "40px 128px 12px";
  }
} 

function initMargin() {
  main.style.paddingTop = navbar.offsetHeight + "px";
}

initMargin();
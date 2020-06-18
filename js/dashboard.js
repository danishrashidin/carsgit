// Set main margin
var main = document.querySelector("main");
var navbar = document.getElementById("navbar");

function init() {
  main.style.top = navbar.offsetHeight + "px";
}

window.onload(init());

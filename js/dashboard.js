// Set main margin
const navbar = document.querySelector("nav");
const dashboard = document.querySelector("main");

function init() {
  dashboard.style.top += navbar.offsetHeight + "px";
  console.log("Set : " + navbar.offsetHeight);
}

dashboard.onload = init();

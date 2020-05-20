// Homepage elements
var navbar = document.getElementById("navbar");
var header = document.querySelector("header");

// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 48 || document.documentElement.scrollTop > 48) {
    // Scrolled position
    navbar.style.padding = "12px 48px 12px";
  } else {
    navbar.style.padding = "40px 128px 12px";
  }
} 

function initHeaderMargin() {
   header.style.marginTop = navbar.offsetHeight + 20 +"px";
}

initHeaderMargin();

var kk8_cafe = [
  {
    img: Object.assign(new Image, {
      src: "assets/restaurant-ahmad.png"
    }),
    name: "Restauran Mohamad Ali bin Mohd Ibrahim",
    location: "Kolej Kediaman Kinabalu",
    operation_hours: "0900-2300",
    menu: "menu.html",
  },
  {
    img: Object.assign(new Image, {
      src: "assets/zaujan-cafe.png"
    }),
    name: "Zaujan Cafe",
    location: "Kolej Kediaman Kinabalu",
    operation_hours: "1000-2400",
    menu: "menu2.html",
  },
  {
    img: Object.assign(new Image, {
      src: "assets/cafe-8884.jpg"
    }),
    name: "Cafe 8884",
    location: "Kolej Kediaman Kinabalu",
    operation_hours: "0900-2300",
    menu: "menu3.html",
  },
];

//^^^assume all menu manully first for front end
for (var i = 0; i < kk8_cafe.length; i++) {
  if ((document.querySelectorAll("#name").length === 1) && (document.querySelector("#name").innerHTML === kk8_cafe[i].name)) {
    document.querySelector(".main-container").style.background = "url('" + kk8_cafe[i].img.src + "')";;
    document.querySelector("#name").innerHTML = kk8_cafe[i].name;
    document.querySelector("#location").innerHTML += " " + kk8_cafe[i].location;
    document.querySelector("#available-hours").innerHTML += " " + kk8_cafe[i].operation_hours;

  }
}

for (var i = 0; i < kk8_cafe.length; i++) {
  if ((document.querySelectorAll("#name").length > 1)) {
    document.querySelectorAll("#res-img")[i].alt = kk8_cafe[i].img.src;
    document.querySelectorAll("#res-img")[i].src = kk8_cafe[i].img.src;
    document.querySelectorAll("#name")[i].innerHTML = kk8_cafe[i].name;
    document.querySelectorAll("#location")[i].innerHTML += " " + kk8_cafe[i].location;
    document.querySelectorAll("#available-hours")[i].innerHTML += " " + kk8_cafe[i].operation_hours;
    document.querySelectorAll("#menu")[i].href = kk8_cafe[i].menu;
  }
}



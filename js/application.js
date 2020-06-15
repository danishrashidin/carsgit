// Homepage elements
var navbar = document.getElementById("navbar");
var header = document.querySelector("header")

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
   header.style.paddingTop = navbar.offsetHeight + "px";
}

initHeaderMargin();

function GetDays() {
  var dropdt = new Date(document.getElementById("drop_date").value);
  var pickdt = new Date(document.getElementById("pick_date").value);
  var days = parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
  if (dropdt == "Invalid Date" || pickdt == "Invalid Date") return 0;
  else if (days < 0) return "Invalid date!";
  else return days;
}

function cal() {
  if (document.getElementById("drop_date")) {
    document.getElementById("numdays2").value = GetDays();
    document.getElementById("totalcost").value = cost();
  }

  function cost() {
    var dropdt = new Date(document.getElementById("drop_date").value);
    var pickdt = new Date(document.getElementById("pick_date").value);
    var cost = parseInt((dropdt - pickdt) / (24 * 3600 * 1000)) * 4;
    if (dropdt == "Invalid Date" || pickdt == "Invalid Date")
      return "RM0";
    else if (cost < 0) return "Invalid date!";
    else return "RM" + cost;
  }
}
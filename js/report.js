navLogInButton = document.querySelector("#submit");
popup = document.querySelector(".fade-background");
dropdown = document.querySelectorAll(".dropdown");
dropdownList = document.querySelectorAll(".dropdown .dropdown-menu li");

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
    if (currentList.parentNode.classList.contains("college")) {
      currentList.parentNode.parentNode.querySelector("input").setAttribute("value", this.getAttribute("id"));
    } else {
      currentList.parentNode.parentNode.querySelector("input").setAttribute("value", this.innerText);
    }
    // currentList.parentNode.parentNode.querySelector("input").setAttribute("value", this.innerText);
    currentList.parentNode.parentNode.style.cssText = "color:black;font-weight:bold";
  });
});

// var table
// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
if (modal != null) {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
if (modal != null) {
  span.onclick = function () {
    modal.style.display = "none";
  };
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
}

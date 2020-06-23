var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
var v;

let buttonRegister = document.querySelectorAll(".button.--register");
let buttonCancelRegister = document.querySelectorAll(".button.--cancelRegister");
let closeRegister = document.querySelectorAll(".close.--register");
let closeCancel = document.querySelectorAll(".close.--cancel");
let registerPopUp = document.querySelector(".activityModal.--registration");
let cancelRegisterPopUp = document.querySelector(".activityModal.--cancelRegistration");
let buttonSubmitRegistration = document.querySelector(".next.--register");
let buttonCancelRegistration = document.querySelector(".next.--cancelRegister");
let registerForm = document.querySelector(".msform.--registration");
let cancelRegistrationForm = document.querySelector(".msform.--cancelRegistration");
let checkYesButton = document.querySelector(".yesCheck");
let registerSuccessMessage = document.querySelector(".fs-content.--register");
let cancelSuccessMessage = document.querySelector(".fs-content.--cancelRegister");
let currentRegisterButton;
let currentCancelRegistrationButton;

buttonRegister.forEach((eachButton) => {
  eachButton.addEventListener("click", () => {
    registerPopUp.style.display = "block";
    registerPopUp.querySelector(".collegeId").value = eachButton.parentNode.parentNode.parentNode.querySelector(
      ".college.--noDisplay"
    ).innerHTML;
    registerPopUp.querySelector(".activityName").value = eachButton.parentNode.querySelector(".activity_name").value;
    currentRegisterButton = eachButton;
  });
});

buttonCancelRegister.forEach((eachCancelButton) => {
  eachCancelButton.addEventListener("click", () => {
    cancelRegisterPopUp.style.display = "block";
    cancelRegisterPopUp.querySelector(
      ".collegeId"
    ).value = eachCancelButton.parentNode.parentNode.parentNode.querySelector(".college.--noDisplay").innerHTML;
    cancelRegisterPopUp.querySelector(".activityName").value = eachCancelButton.parentNode.querySelector(
      ".activity_name"
    ).value;
    currentCancelRegistrationButton = eachCancelButton;
  });
});

closeRegister.forEach((eachButton) => {
  eachButton.addEventListener("click", () => {
    registerPopUp.style.display = "none";
    closeOverlay(document.querySelector(".close.action-button.--register"));
  });
});

closeCancel.forEach((eachButton) => {
  eachButton.addEventListener("click", () => {
    cancelRegisterPopUp.style.display = "none";
    closeOverlay(document.querySelector(".close.action-button.--cancel"));
  });
});

buttonSubmitRegistration.addEventListener("click", () => {
  const formData = new FormData(registerForm);
  buttonSubmitRegistration.innerHTML = `
    <div class="lds-ellipsis" style="width: 57.0px; height: 22px left: -4px;">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    `;

  fetch("activityHandler.php", {
    method: "post",
    body: formData,
  })
    .then((response) => {
      return response.json();
    })
    .then((registration) => {
      console.log(registration);
      if (registration.status == "success") {
        currentRegisterButton.parentNode.insertAdjacentHTML(
          "beforeend",
          `<a  class="button --cancelRegister">Cancel Registration</a>`
        );
        cancelButton = currentRegisterButton.parentNode.querySelector(".button.--cancelRegister");
        console.log(cancelButton.parentNode.parentNode.parentNode);

        (function (button) {
          button.addEventListener("click", () => {
            cancelRegisterPopUp.style.display = "block";

            cancelRegisterPopUp.querySelector(
              ".collegeId"
            ).value = button.parentNode.parentNode.parentNode.querySelector(".college.--noDisplay").innerHTML;
            cancelRegisterPopUp.querySelector(".activityName").value = button.parentNode.querySelector(
              ".activity_name"
            ).value;
            currentCancelRegistrationButton = button;
            console.log(button.parentNode.parentNode.parentNode);
          });
        })(cancelButton);

        currentRegisterButton.parentNode.parentNode.parentNode.querySelector(".status").innerHTML = "Pending";
        currentRegisterButton.remove();
        currentRegisterButton = null;
        buttonSubmitRegistration.innerHTML = "Next";
        registerSuccessMessage.innerHTML = `Congratulations! You have registered for ` + registration.activityName;
        transition(buttonSubmitRegistration);
      }
    })
    .catch((error) => {
      console.log(error);
    });
});

if (true) {
  console.log(buttonCancelRegistration);
  buttonCancelRegistration.addEventListener("click", () => {
    if (checkYesButton.checked == true) {
      const formData = new FormData(cancelRegistrationForm);
      buttonCancelRegistration.innerHTML = `
    <div class="lds-ellipsis" style="width: 57.0px; height: 22px left: -4px;">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    `;

      fetch("activityHandler.php", {
        method: "post",
        body: formData,
      })
        .then((response) => {
          return response.json();
        })
        .then((cancelation) => {
          if (cancelation.status == "success") {
            currentCancelRegistrationButton.parentNode.insertAdjacentHTML(
              "beforeend",
              `<a class="button --register">Register Now!</a>`
            );

            registerButton = currentCancelRegistrationButton.parentNode.querySelector(".button.--register");

            (function (button) {
              button.addEventListener("click", () => {
                registerPopUp.style.display = "block";
                registerPopUp.querySelector(".collegeId").value = button.parentNode.parentNode.parentNode.querySelector(
                  ".college.--noDisplay"
                ).innerHTML;
                registerPopUp.querySelector(".activityName").value = button.parentNode.querySelector(
                  ".activity_name"
                ).value;
                currentRegisterButton = button;
              });
            })(registerButton);
            currentCancelRegistrationButton.parentNode.parentNode.parentNode.querySelector(".status").innerHTML =
              "Available";
            currentCancelRegistrationButton.parentNode.parentNode.parentNode.querySelector(".status").style.background =
              "#00df89";
            currentCancelRegistrationButton.remove();
            currentCancelRegistrationButton = null;
            buttonCancelRegistration.innerHTML = "Next";
            cancelSuccessMessage.innerHTML = `You have cancelled your registration for ` + cancelation.activityName;
            transition(buttonCancelRegistration);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    } else {
      cancelRegisterPopUp.style.display = "none";
    }
  });
}

function transition(button) {
  if (animating) return false;
  animating = true;

  current_fs = $(button).parent();
  next_fs = $(button).parent().next();

  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

  //show the next fieldset
  next_fs.show();
  //hide the current fieldset with style
  current_fs.animate(
    { opacity: 0 },
    {
      step: function (now, mx) {
        //as the opacity of current_fs reduces to 0 - stored in "now"
        //1. scale current_fs down to 80%
        scale = 1 - (1 - now) * 0.2;
        //2. bring next_fs from the right(50%)
        left = now * 50 + "%";
        //3. increase opacity of next_fs to 1 as it moves in
        opacity = 1 - now;
        current_fs.css({
          transform: "scale(" + scale + ")",
          position: "absolute",
        });
        next_fs.css({ left: left, opacity: opacity });
      },
      duration: 800,
      complete: function () {
        current_fs.hide();
        animating = false;
      },
      //this comes from the custom easing plugin
      easeInOutBack: function (t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        if ((t /= d / 2) < 1) return (c / 2) * (t * t * (((s *= 1.525) + 1) * t - s)) + b;
        return (c / 2) * ((t -= 2) * t * (((s *= 1.525) + 1) * t + s) + 2) + b;
      },
    }
  );
}

function closeOverlay(button) {
  if (animating) return false;
  animating = true;

  current_fs = $(button).parent();
  previous_fs = $(button).parent().prev();

  //de-activate current step on progressbar
  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

  //show the previous fieldset
  previous_fs.show();
  //hide the current fieldset with style
  current_fs.animate(
    { opacity: 0 },
    {
      step: function (now, mx) {
        //as the opacity of current_fs reduces to 0 - stored in "now"
        //1. scale previous_fs from 80% to 100%
        scale = 0.8 + (1 - now) * 0.2;
        //2. take current_fs to the right(50%) - from 0%
        left = (1 - now) * 50 + "%";
        //3. increase opacity of previous_fs to 1 as it moves in
        opacity = 1 - now;
        current_fs.css({ left: left });
        previous_fs.css({ transform: "scale(" + scale + ")", opacity: opacity });
      },
      duration: 800,
      complete: function () {
        current_fs.hide();
        animating = false;
      },
      //this comes from the custom easing plugin
      easeInOutBack: function (t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        if ((t /= d / 2) < 1) return (c / 2) * (t * t * (((s *= 1.525) + 1) * t - s)) + b;
        return (c / 2) * ((t -= 2) * t * (((s *= 1.525) + 1) * t + s) + 2) + b;
      },
    }
  );
}

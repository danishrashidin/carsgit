export default class SignUp {
  constructor() {
    this.injectHTML();
    document.addEventListener("DOMContentLoaded", () => {
      this.navSignUpButton = document.querySelector("#button-sign-up");
      //----------------------------LogInComponent----------------------------//
      this.modalLogIn = document.querySelector(".shadowBox.log-in");
      this.typed;

      //----------------------------SignUpComponent----------------------------//
      this.modalBackground = document.querySelector(".fade-background");
      this.modalSignUp = document.querySelector(".shadowBox.sign-up");
      this.modalVerify = document.querySelector(".shadowBox.verify");
      this.signUpForm = document.querySelector(".sign-up-form");
      this.signUpButton = document.querySelector(".sign-up-button");
      this.logInButton = document.querySelector("#log-in");
      this.dropdown = document.querySelectorAll(".dropdown");
      this.dropdownList = document.querySelectorAll(".dropdown .dropdown-menu li");
      this.progressBar = document.querySelector(".progress-bar");
      this.tooltipPassword = document.querySelector("#tippy-template");
      this.tooltipEmail = document.querySelector("#email-check-template");
      this.tooltipMatricNumber = document.querySelector("#matricNumber-check-template");
      this.passwordVisibility = document.querySelector(".sign-up-password-check-icon");
      this.label = document.querySelectorAll(".--reset");
      this.labelFullName = document.querySelector(".label-full-name");
      this.labelMatricNumber = document.querySelector(".label-matric-number");
      this.labelEmail = document.querySelector(".label-email");
      this.labelPassword = document.querySelector(".label-password");
      this.labelConfirmPassword = document.querySelector(".label-confirm-password");
      this.labelDropdown1 = document.querySelector(".dropdown1");
      this.labelDropdown2 = document.querySelector(".dropdown2");
      this.input = document.querySelectorAll("input");
      this.inputBoxFullName = document.querySelector("#inputBox-full-name");
      this.inputBoxMatricNumber = document.querySelector("#inputBox-matric-number");
      this.inputBoxEmail = document.querySelector("#inputBox-email");
      this.inputBoxPassword = document.querySelector("#inputBox-password");
      this.inputBoxConfirmPassword = document.querySelector("#inputBox-confirm-password");
      this.notificationTitle = document.querySelector(".notification-title");
      this.notificationMessage = document.querySelector(".notification-message");
      this.userVerified = document.querySelector(".--verificationSuccessfull");
      this.passwordStrength;
      this.emailStatus;
      this.matricNumberStatus;
      this.feedbackMessage;
      this.funFactMessage;
      this.URL;
      this.declareTooltips();
      this.events();
    });
  }

  //--------------------------------------------------------Events--------------------------------------------------------//
  events() {
    if (this.userVerified) this.showVerifiedEmailMessage();
    if (this.navSignUpButton) this.navSignUpButton.addEventListener("click", () => this.openSignUpOverlay());
    this.modalBackground.addEventListener("click", (e) => this.closeSignUpOverlay(e));
    this.signUpForm.addEventListener("submit", (e) => this.submit(e));
    this.signUpForm.addEventListener("focusin", (e) => this.focusIn(e));
    this.signUpForm.addEventListener("focusout", (e) => this.focusOut(e));
    this.logInButton.addEventListener("click", (e) => this.slideOutSignUp());
    this.passwordVisibility.addEventListener("click", () => this.togglePasswordVisibility());
    this.dropdown.forEach((targetedDropdown) => {
      targetedDropdown.addEventListener("click", () => this.dropOverlay(targetedDropdown));
      targetedDropdown.addEventListener("focusout", () => this.closeOverlay(targetedDropdown));
    });
    this.dropdownList.forEach((targetedList) => {
      targetedList.addEventListener("click", () => this.selectList(targetedList));
    });
    this.inputBoxFullName.addEventListener("keydown", (e) => this.filterName(e));
    this.inputBoxFullName.addEventListener("input", (e) => this.checkName(e));
    this.inputBoxMatricNumber.addEventListener("keydown", (e) => this.filterMatricNumber(e));
    this.inputBoxMatricNumber.addEventListener("input", (e) => this.checkMatricNumber(e));
    this.inputBoxPassword.addEventListener("keydown", (e) => this.disableWhiteSpaces(e));
    this.inputBoxPassword.addEventListener("input", () => this.onChange());
    this.inputBoxConfirmPassword.addEventListener("keydown", (e) => this.disableWhiteSpaces(e));
    this.inputBoxConfirmPassword.addEventListener("input", () => this.checkPasswordSimilarity());
    this.inputBoxEmail.addEventListener("keydown", (e) => this.disableWhiteSpaces(e));
    this.inputBoxEmail.addEventListener("input", () => this.checkEmailValidity());
  }

  //--------------------------------------------------------Methods--------------------------------------------------------//
  declareTooltips() {
    tippy(document.querySelector("#inputBox-email"), {
      theme: "white",
      content: document.getElementById("email-check-template"),
      allowHTML: true,
      placement: "right-start",
      offset: [0, 15],
      arrow: true,
      maxWidth: 600,
      arrowType: "sharp",
      animation: "scale",
      inertia: true,
      hideOnClick: false,
      trigger: "focusin",
    });
    tippy(document.querySelector("#inputBox-password"), {
      theme: "white",
      content: document.getElementById("tippy-template"),
      allowHTML: true,
      placement: "right-start",
      arrow: true,
      arrowType: "sharp",
      animation: "scale",
      inertia: true,
      hideOnClick: false,
      trigger: "focusin",
    });
    tippy(document.querySelector("#inputBox-matric-number"), {
      theme: "white",
      content: document.getElementById("matricNumber-check-template"),
      allowHTML: true,
      placement: "right-start",
      offset: [0, 15],
      arrow: true,
      maxWidth: 600,
      arrowType: "sharp",
      animation: "scale",
      inertia: true,
      hideOnClick: false,
      trigger: "focusin",
    });
  }

  stripHtml(html) {
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
  }

  submit(e) {
    e.preventDefault();
    if (
      this.labelFullName.querySelector(".fa-check-circle") &&
      this.labelMatricNumber.querySelector(".fa-check-circle") &&
      this.labelEmail.querySelector(".fa-check-circle") &&
      this.labelPassword.querySelector(".fa-check-circle") &&
      this.labelConfirmPassword.querySelector(".fa-check-circle") &&
      this.labelDropdown1.querySelector(".fa-check-circle") &&
      this.labelDropdown2.querySelector(".fa-check-circle")
    ) {
      this.signUpButton.innerHTML = `
      <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
      `;

      const formData = new FormData(this.signUpForm);
      fetch("registrationHandler.php", {
        method: "post",
        body: formData,
      })
        .then((response) => {
          return response.text();
        })
        .then((dataReceived) => {
          if (dataReceived == "Successful") {
            this.closeSignUpOverlay("register");
            this.signUpButton.innerHTML = "Submit";
            this.notificationTitle.innerHTML = `
            Verify your SiswaMail
            `;
            this.notificationMessage.innerHTML =
              `
            Your account has been successfully made! We now need to verify your SiswaMail. We've sent an email to
            <strong>` +
              this.stripHtml(DOMPurify.sanitize(this.inputBoxEmail.value)) +
              ` </strong> to verify your email address. Please click the verify button in that email to complete the registration
            process.
            `;
            this.modalVerify.classList.add("animate__bounceInDown");
            this.modalVerify.style.display = "flex";
          }
        })
        .catch((err) => {
          console.log(err);
        });
    }
  }

  openSignUpOverlay() {
    document.querySelector("body").classList.add("stop-scrolling");
    this.modalSignUp.classList.add("animate__bounceInDown");
    this.modalBackground.style.display = "flex";
    this.modalSignUp.style.display = "block";

    setTimeout(() => {
      this.modalSignUp.classList.remove("animate__bounceInDown");
    }, 3000);
  }

  closeSignUpOverlay(e) {
    if (e.target == this.modalBackground) {
      document.querySelector("body").classList.remove("stop-scrolling");
      this.modalBackground.style.display = "none";
      this.modalSignUp.style.display = "none";
      this.modalVerify.style.display = "none";
      this.modalSignUp.classList.remove("animate__bounceInDown");
      this.modalVerify.classList.remove("animate__bounceInDown");
      this.signUpButton.innerHTML = "Submit";
      this.signUpForm.reset();

      this.label.forEach((eachLabel) => {
        eachLabel.classList.remove("sign-up-activated");
        if (eachLabel.querySelector(".fa-times-circle")) {
          eachLabel.querySelector(".fas").classList.remove("fa-times-circle");
        }
        if (eachLabel.querySelector(".fa-check-circle")) {
          eachLabel.querySelector(".fas").classList.remove("fa-check-circle");
        }
      });
      this.input.forEach((eachInputBox) => {
        if (eachInputBox.getAttribute("name") == "forgot-email") return;
        eachInputBox.style.border = "none";
        if (eachInputBox.getAttribute("name") == "action") return;
        eachInputBox.setAttribute("value", "");
        eachInputBox.previousElementSibling.classList.remove("log-in-label-activated");
        eachInputBox.previousElementSibling.classList.remove("reset-password-label-activated");
        eachInputBox.style.backgroundColor = "rgb(238, 238, 238)";
      });
      this.dropdown.forEach((eachDropdown) => {
        eachDropdown.style.border = "none";
        eachDropdown.querySelector("span").innerText = "";
        eachDropdown.querySelector(".dropdown-label").classList.remove("activated");
        eachDropdown.querySelector(".dropdown-label").style.color = "rgb(133, 127, 127)";
      });

      if (
        !this.passwordVisibility.classList.contains("fa-eye-slash") &&
        this.passwordVisibility.classList.contains("fa-eye")
      ) {
        this.togglePasswordVisibility();
      }
      this.passwordVisibility.classList.remove("fa-eye-slash");
      this.tooltipEmail.querySelector(".validity").innerHTML = " ";
      this.tooltipPassword.querySelector(".strength").innerHTML = " ";
      this.tooltipPassword.querySelector(".feedback").innerHTML = " ";
      this.tooltipPassword.querySelector(".funfact").innerHTML = " ";
      document.documentElement.style.setProperty("--progressBarColor", "rgba(197, 197, 197, 0)");
      this.progressBar.style.setProperty("--width", 0);
    } else if (e == "register") {
      this.modalSignUp.style.display = "none";
      this.modalSignUp.classList.remove("animate__bounceInDown");
    }
  }

  showVerifiedEmailMessage() {
    document.querySelector("body").classList.add("stop-scrolling");
    this.modalBackground.style.display = "flex";
    this.notificationTitle.innerHTML = `
            Verification Successfull <i class="fas fa-check" style="color: rgb(12, 143, 12)"></i>
            `;
    this.notificationMessage.innerHTML = `
            <strong>Congratulation!</strong> your email was successfully verified. You can now login.
            `;
    this.modalVerify.classList.add("animate__bounceInDown");
    this.modalVerify.style.display = "flex";
  }

  slideOutSignUp() {
    this.modalSignUp.classList.add("animate__bounceOutDown");
    this.modalLogIn.classList.add("animate__bounceInDown");
    this.typed = new Typed("#typed", {
      stringsElement: "#typed-strings",
      typeSpeed: 40,
    });

    setTimeout(() => {
      this.modalLogIn.style.display = "block";
      setTimeout(() => {
        this.modalSignUp.classList.remove("animate__bounceOutDown");
        this.modalLogIn.classList.remove("animate__bounceInDown");
        this.modalSignUp.style.display = "none";
      }, 1000);
    }, 490);
  }

  focusIn(e) {
    if (e.target.previousElementSibling) {
      e.target.previousElementSibling.classList.add("sign-up-activated");
    }
  }

  focusOut(e) {
    if (!e.target.value && e.target.previousElementSibling) {
      e.target.previousElementSibling.classList.remove("sign-up-activated");
      e.target.previousElementSibling.querySelector(".fas").classList.remove("fa-check-circle");
      e.target.previousElementSibling.querySelector(".fas").classList.remove("fa-times-circle");
      e.target.style.border = "none";
    }
  }
  onChange() {
    if (!this.inputBoxPassword.value) {
      this.passwordVisibility.classList.remove("fa-eye", "fa-eye-slash");
      this.inputBoxPassword.type = "password";
    }
    if (this.inputBoxPassword.value && this.inputBoxPassword.type === "password") {
      this.passwordVisibility.classList.add("fa-eye-slash");
    }

    if (this.inputBoxConfirmPassword.value) {
      clearTimeout(this.inputBoxConfirmPassword.timer);
      this.inputBoxConfirmPassword.timer = setTimeout(() => this.checkPasswordSimilarity(), 400);
    }

    this.passwordStrength = zxcvbn(this.inputBoxPassword.value);
    clearTimeout(this.inputBoxPassword.timer);
    this.inputBoxPassword.timer = setTimeout(() => {
      if (this.passwordStrength.score > 1 && !this.labelPassword.querySelector(".fa-check-circle")) {
        if (this.labelPassword.querySelector(".fa-times-circle")) {
          this.labelPassword.querySelector(".fas").classList.remove("fa-times-circle");
        }
        this.labelPassword.querySelector(".fas").classList.add("fa-check-circle");
        this.inputBoxPassword.style.border = "1.5px solid green";
      }
      if (this.passwordStrength.score < 2) {
        if (this.labelPassword.querySelector(".fa-check-circle")) {
          this.labelPassword.querySelector(".fas").classList.remove("fa-check-circle");
        }
        this.labelPassword.querySelector(".fas").classList.add("fa-times-circle");
        this.inputBoxPassword.style.border = "1.5px solid red";
      }
    }, 400);

    if (this.inputBoxPassword.value == "") {
      this.passwordStrength.score = -1;
    }
    this.feedbackMessage =
      "Password should be at least 8 characters long. Try using uncommon words or inside jokes, non-standard uppercasing, creative spelling and non-obvious numbers and symbols. " +
      this.passwordStrength.feedback.warning;

    this.funFactMessage =
      "It would take hackers, " +
      this.passwordStrength.crack_times_display.online_no_throttling_10_per_second +
      " to crack this password of yours based on " +
      Math.round(this.passwordStrength.guesses) +
      " number of guesses attempt";

    switch (this.passwordStrength.score) {
      case -1:
        this.tooltipPassword.querySelector(".strength").innerHTML = " ";
        this.tooltipPassword.querySelector(".feedback").innerHTML = this.feedbackMessage;
        this.tooltipPassword.querySelector(".funfact").innerHTML = this.funFactMessage;
        document.documentElement.style.setProperty("--progressBarColor", "rgba(197, 197, 197, 0)");
        this.progressBar.style.setProperty("--width", 0);
        break;

      case 0:
        this.tooltipPassword.querySelector(".strength").innerHTML = "Too easy to guess...";
        this.tooltipPassword.querySelector(".feedback").innerHTML = this.feedbackMessage;
        this.tooltipPassword.querySelector(".funfact").innerHTML = this.funFactMessage;
        document.documentElement.style.setProperty("--progressBarColor", "rgb(207, 19, 19)");
        this.progressBar.style.setProperty("--width", 20);
        break;

      case 1:
        this.tooltipPassword.querySelector(".strength").innerHTML = "Still too risky";
        this.tooltipPassword.querySelector(".feedback").innerHTML = this.feedbackMessage;
        this.tooltipPassword.querySelector(".funfact").innerHTML = this.funFactMessage;
        document.documentElement.style.setProperty("--progressBarColor", "rgb(224, 89, 11)");
        this.progressBar.style.setProperty("--width", 40);
        break;

      case 2:
        this.tooltipPassword.querySelector(".strength").innerHTML = "Less risky, we'll take it";
        this.tooltipPassword.querySelector(".feedback").innerHTML = this.feedbackMessage;
        this.tooltipPassword.querySelector(".funfact").innerHTML = this.funFactMessage;
        document.documentElement.style.setProperty("--progressBarColor", "rgb(221, 224, 11)");
        this.progressBar.style.setProperty("--width", 60);
        break;

      case 3:
        this.tooltipPassword.querySelector(".strength").innerHTML = "Good one! Now we're talking";
        this.tooltipPassword.querySelector(".feedback").innerHTML = this.feedbackMessage;
        this.tooltipPassword.querySelector(".funfact").innerHTML = this.funFactMessage;
        document.documentElement.style.setProperty("--progressBarColor", "rgb(3, 94, 230)");
        this.progressBar.style.setProperty("--width", 80);
        break;

      case 4:
        this.tooltipPassword.querySelector(".strength").innerHTML = "Whoa, that's one strong password!";
        this.tooltipPassword.querySelector(".feedback").innerHTML = this.feedbackMessage;
        this.tooltipPassword.querySelector(".funfact").innerHTML = this.funFactMessage;
        document.documentElement.style.setProperty("--progressBarColor", "rgb(9, 119, 9)");
        this.progressBar.style.setProperty("--width", 100);
        break;
    }
  }

  togglePasswordVisibility() {
    this.passwordVisibility.classList.toggle("fa-eye-slash");
    this.passwordVisibility.classList.toggle("fa-eye");
    if (this.inputBoxPassword.type === "password") {
      this.inputBoxPassword.type = "text";
    } else {
      this.inputBoxPassword.type = "password";
    }
  }

  dropOverlay(targetedDropdown) {
    targetedDropdown.focus();
    targetedDropdown.classList.toggle("active");
    targetedDropdown.querySelector(".dropdown-menu").classList.toggle("slideToggle");
  }

  closeOverlay(targetedDropdown) {
    targetedDropdown.classList.remove("active");
    targetedDropdown.querySelector(".dropdown-menu").classList.remove("slideToggle");
  }

  selectList(targetedList) {
    targetedList.parentNode.parentNode.querySelector(".dropdown-label").classList.add("activated");
    targetedList.parentNode.parentNode.querySelector("span").innerText = targetedList.innerText;
    targetedList.parentNode.parentNode.querySelector("span").style.display = "inline";
    targetedList.parentNode.parentNode.querySelector("input").setAttribute("value", targetedList.innerText);
    if (!targetedList.parentNode.parentNode.querySelector(".fas")) {
      setTimeout(function () {
        targetedList.parentNode.parentNode
          .querySelector(".dropdown-label")
          .insertAdjacentHTML("beforeend", `&nbsp <i class="fas fa-check-circle"></i>`);
      }, 200);
    }
    targetedList.parentNode.parentNode.style.cssText = "border:1.5px solid green;color:black;font-weight:bold";
  }

  filterName(e) {
    if (
      !e.key.match(
        /(^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$)/g
      )
    ) {
      e.preventDefault();
    }
  }

  filterMatricNumber(e) {
    if (e.keyCode == 8 || e.keyCode == 9) return;
    if (!e.key.match(/(^[0-9])/g)) {
      e.preventDefault();
    }
  }

  disableWhiteSpaces(e) {
    if (e.keyCode == 32) e.preventDefault();
  }

  checkPasswordSimilarity() {
    clearTimeout(this.inputBoxConfirmPassword.timer);
    this.inputBoxConfirmPassword.timer = setTimeout(() => {
      if (
        this.inputBoxConfirmPassword.value == this.inputBoxPassword.value &&
        !this.labelConfirmPassword.querySelector(".fa-check-circle") &&
        this.inputBoxConfirmPassword.value
      ) {
        if (this.labelConfirmPassword.querySelector(".fa-times-circle")) {
          this.labelConfirmPassword.querySelector(".fas").classList.remove("fa-times-circle");
        }
        this.labelConfirmPassword.querySelector(".fas").classList.add("fa-check-circle");
        this.inputBoxConfirmPassword.style.border = "1.5px solid green";
      } else {
        if (this.labelConfirmPassword.querySelector(".fa-check-circle")) {
          this.labelConfirmPassword.querySelector(".fas").classList.remove("fa-check-circle");
        }
        this.labelConfirmPassword.querySelector(".fas").classList.add("fa-times-circle");
        this.inputBoxConfirmPassword.style.border = "1.5px solid red";
      }
    }, 1000);
  }

  checkEmailValidity() {
    clearTimeout(this.inputBoxEmail.timer);
    this.inputBoxEmail.timer = setTimeout(() => {
      fetch("registrationHandler.php", {
        method: "post",
        body: new URLSearchParams("email=" + this.inputBoxEmail.value + "&action=checkEmail"),
      })
        .then((response) => {
          return response.text();
        })
        .then((status) => {
          this.emailStatus = status;
          this.emailValidity = this.inputBoxEmail.value.match(/(@siswa.um.edu.my)/g);

          if (
            this.emailValidity &&
            !this.labelEmail.querySelector(".fa-check-circle") &&
            this.emailStatus == "unique"
          ) {
            if (this.labelEmail.querySelector(".fa-times-circle")) {
              this.labelEmail.querySelector(".fas").classList.remove("fa-times-circle");
            }
            this.labelEmail.querySelector(".fas").classList.add("fa-check-circle");
            this.inputBoxEmail.style.border = "1.5px solid green";
            this.tooltipEmail.querySelector(".validity").innerHTML = "SiswaMail is valid <br> and unique";
            this.tooltipEmail.querySelector(".validity").style.color = "green";
          }

          if (!this.emailValidity || this.emailStatus == "taken") {
            if (this.labelEmail.querySelector(".fa-check-circle")) {
              this.labelEmail.querySelector(".fas").classList.remove("fa-check-circle");
            }
            this.labelEmail.querySelector(".fas").classList.add("fa-times-circle");
            this.inputBoxEmail.style.border = "1.5px solid red";
            this.tooltipEmail.querySelector(".validity").style.color = "red";

            if (this.emailStatus == "taken") {
              this.tooltipEmail.querySelector(".validity").innerHTML = "Student has already <br> registered";
            } else {
              this.tooltipEmail.querySelector(".validity").innerHTML = "Invalid SiswaMail";
            }
          }
        })
        .catch((err) => {
          console.log(err);
        });
    }, 500);
  }

  checkName(e) {
    clearTimeout(e.target.timer);
    e.target.timer = setTimeout(() => {
      if (e.target.value && !e.target.previousElementSibling.querySelector(".fa-check-circle")) {
        if (e.target.previousElementSibling.querySelector(".fa-times-circle")) {
          e.target.previousElementSibling.querySelector(".fas").classList.remove("fa-times-circle");
        }
        e.target.previousElementSibling.querySelector(".fas").classList.add("fa-check-circle");
        e.target.style.border = "1.5px solid green";
      }
      if (!e.target.value) {
        if (e.target.previousElementSibling.querySelector(".fa-check-circle")) {
          e.target.previousElementSibling.querySelector(".fas").classList.remove("fa-check-circle");
        }
        e.target.previousElementSibling.querySelector(".fas").classList.add("fa-times-circle");
        e.target.style.border = "1.5px solid red";
      }
    }, 100);
  }

  checkMatricNumber(e) {
    fetch("registrationHandler.php", {
      method: "post",
      body: new URLSearchParams("Matric_Number=" + this.inputBoxMatricNumber.value + "&action=checkMatricNumber"),
    })
      .then((response) => {
        return response.text();
      })
      .then((status) => {
        this.matricNumberStatus = status;
        clearTimeout(this.inputBoxMatricNumber.timer);
        this.inputBoxMatricNumber.timer = setTimeout(() => {
          if (!this.labelMatricNumber.querySelector(".fa-check-circle") && this.matricNumberStatus == "exist") {
            if (this.labelMatricNumber.querySelector(".fa-times-circle")) {
              this.labelMatricNumber.querySelector(".fas").classList.remove("fa-times-circle");
            }
            this.labelMatricNumber.querySelector(".fas").classList.add("fa-check-circle");
            this.inputBoxMatricNumber.style.border = "1.5px solid green";
            this.tooltipMatricNumber.querySelector(".validity").innerHTML = "Student exists";
            this.tooltipMatricNumber.querySelector(".validity").style.color = "green";
          }

          if (this.matricNumberStatus == "null") {
            if (this.labelMatricNumber.querySelector(".fa-check-circle")) {
              this.labelMatricNumber.querySelector(".fas").classList.remove("fa-check-circle");
            }
            this.labelMatricNumber.querySelector(".fas").classList.add("fa-times-circle");
            this.inputBoxMatricNumber.style.border = "1.5px solid red";
            this.tooltipMatricNumber.querySelector(".validity").style.color = "red";
            this.tooltipMatricNumber.querySelector(".validity").innerHTML = "Student doesn't exists";
          }
        }, 500);
      })
      .catch((err) => {
        console.log(err);
      });
  }

  injectHTML() {
    document.querySelector(".fade-background").insertAdjacentHTML(
      "beforeend",
      `<div class="shadowBox sign-up container-fluid animate__animated">
        <div class="row no-gutters">
          <div class="col-sm-4">
            <div
              id="carousel-signUp"
              class="carousel slide"
              data-ride="carousel"
            >
              <ol class="carousel-indicators">
                <li
                  data-target="#carousel-signUp"
                  data-slide-to="0"
                  class="active"
                ></li>
                <li
                  data-target="#carousel-signUp"
                  data-slide-to="1"
                ></li>
                <li
                  data-target="#carousel-signUp"
                  data-slide-to="2"
                ></li>
                <li
                  data-target="#carousel-signUp"
                  data-slide-to="3"
                ></li>
              </ol>
              <div class="carousel-inner sign-up-column-1">
                <div class="carousel-item active" id="img-1">
                  <div class="carousel-caption d-none d-md-block">
                    <h1 class="carousel-title mb-0">All in one</h1>
                    <p class="mt-0">All college activities in one place</p>
                  </div>
                </div>
                <div class="carousel-item" id="img-2">
                <div class="carousel-caption d-none d-md-block">
                <h1 class="carousel-title mb-0">View & Order</h1>
                    <p class="mt-0">Display food menu at residential colleges</p>
                  </div>
                </div>
                <div class="carousel-item" id="img-3">
                <div class="carousel-caption d-none d-md-block">
                <h1 class="carousel-title mb-0">Issue Reporting</h1>
                    <p class="mt-0">Report a new issue found at residential college</p>
                  </div>
                </div>
                <div class="carousel-item" id="img-4">
                <div class="carousel-caption d-none d-md-block">
                <h1 class="carousel-title mb-0">Accommodation</h1>
                    <p class="mt-0">Apply for accommodation during semester break</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-8 sign-up-column-2">
            <form class="container-fluid sign-up-form" autocomplete="on" method="POST">
              <input type="hidden" name="action" value="register">

              <div class="row no-gutters ">
                <div class="col text-left ">
                  <h6 class="font-weight-bolder">Create an account</h6>
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col text-right">
                  <label for="full-name" class="sign-up-label label-full-name --reset"
                    >&nbsp; Full Name &nbsp; <i class="fas "></i>
                  </label>
                  <input
                    type="text"
                    id="inputBox-full-name"
                    name="full-name"
                    class="sign-up-input-box"
                    onpaste="return false;"
                    required
                  />
                </div>
                <div class="col text-left">
                  <div id="matricNumber-check-template">
                    <p class="validity-label">
                      Checking database: 
                      <span class="validity"></span>
                    </p>
                  </div>

                  <label
                    for="matric-number"
                    class="sign-up-label label-matric-number label-right --reset"
                    >&nbsp; Matric Number (New) &nbsp; <i class="fas "></i></label
                  >
                  <input
                    type="text"
                    id="inputBox-matric-number"
                    name="matric-number"
                    class="sign-up-input-box"
                    onpaste="return false;"
                    required
                  />
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col text-center">
                  <div id="email-check-template">
                    <p class="validity-label">
                      Email Validity: 
                      <span class="validity"></span>
                    </p>
                  </div>

                  <label for="email" class="sign-up-label label-email --reset"
                    >&nbsp; SiswaMail &nbsp; <i class="fas "></i></label
                  >
                  <input
                    type="text"
                    id="inputBox-email"
                    name="email"
                    class="sign-up-input-box email-box"
                    onpaste="return false;"
                    required
                  />
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col-6 text-right">
                  <div id="tippy-template">
                    <p class="strength-label">
                      Password Strength: &nbsp; &nbsp;
                      <span class="strength"></span>
                    </p>
                    <div class="progress-bar" style="--width: 1;"></div>
                    <p class="feedback"></p>
                    <strong class="strength-label">Fun Fact:</strong>
                    <p class="funfact"></p>
                  </div>

                  <label for="password" class="sign-up-label label-password --reset"
                    >&nbsp; Password &nbsp; <i class="fas "></i></label
                  >
                  <input
                    type="password"
                    id="inputBox-password"
                    name="password"
                    class="sign-up-input-box"
                    data-tippy-content=""
                    onpaste="return false;"
                    required
                  />
                  <i class="fas sign-up-password-check-icon"></i>
                </div>
                <div class="col text-left">
                  <label
                    for="confirm-password"
                    class="sign-up-label label-confirm-password label-right --reset"
                    >&nbsp; Confirm Password &nbsp; <i class="fas "></i></label
                  >
                  <input
                    type="password"
                    id="inputBox-confirm-password"
                    name="confirm-password"
                    class="sign-up-input-box"
                    onpaste="return false;"
                    required
                  />
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col-6 text-right">
                  <!-- <label for="college" class="label">&nbsp; College</label> -->
                  <div class="dropdown" tabindex="1">
                  <div class="select">
                  <span style="display: none;"></span>
                  </div>
                  <label for="residential-college" class="dropdown-label dropdown1 --reset">
                    Residential College
                  </label>
                    <input type="text" name="college" required 
                    style="border:none; outline: none; background: red; position: absolute; top:13px; left:10px; opacity: 0; pointer-events: none;"/>
                    <ul class="dropdown-menu">
                      <li id="1">ULK</li>
                      <li id="2">1st Residential College</li>
                      <li id="3">2nd Residential College</li>
                      <li id="4">3rd Residential College</li>
                      <li id="5">4th Residential College</li>
                      <li id="6">5th Residential College</li>
                      <li id="7">6th Residential College</li>
                      <li id="8">7th Residential College</li>
                      <li id="9">8th Residential College</li>
                      <li id="10">9th Residential College</li>
                      <li id="11">10th Residential College</li>
                      <li id="12">11th Residential College</li>
                      <li id="13">12th Residential College</li>
                    </ul>
                  </div>
                </div>
                <div class="col-6 text-left special">
                  <div class="dropdown" tabindex="1">
                    <div class="select">
                      <span style="display: none;"></span>
                    </div>
                    <label for="residential-college" class="dropdown-label dropdown2 --reset">
                      Faculty</label
                    >
                    <input type="text" name="faculty" required                     
                    style="border:none; outline: none; background: red; position: absolute; top:13px; left:10px; opacity: 0; pointer-events: none;"/>
                    <ul class="dropdown-menu">
                      <li id="1">Faculty Of Education</li>
                      <li id="2">Faculty of Dentistry</li>
                      <li id="3">Faculty of Engineering</li>
                      <li id="4">Faculty of Science</li>
                      <li id="5">Faculty of Law</li>
                      <li id="6">Faculty of Medicine</li>
                      <li id="7">Faculty of Medicine</li>
                      <li id="8">Faculty of Arts and Social Sciences</li>
                      <li id="9">Faculty of Business and Accountancy</li>
                      <li id="10">Faculty of Economics and Administration</li>
                      <li id="11">Faculty of Languages and Linguistics</li>
                      <li id="12">
                        Faculty of Computer Science & Information Technology
                      </li>
                      <li id="13">
                        Faculty of Built Environment
                      </li>
                      <li id="14">
                        Faculty of Pharmacy
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="row no-gutters mb-3">
                <div class="col-3">
                  <button
                    type="submit" class="sign-up-button mt-3 mb-2 font-weight-bold"
                  >
                  Submit 
                  </button>
                </div>
                <div class="col-9">
                  <p id="have-account">
                    Already have an account?
                    <a id="log-in">Log In</a> <br />
                    
                      By signing up, you agree to our
                      <a href="#" id="term-condition">Terms of Use</a> and
                      <a href="#" id="term-condition"> Privacy Policy</a>
                    
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="shadowBox verify container-fluid animate__animated" style="display: none;">
        <div class="row verify no-gutters">
          <div class="col verify-title">
            <h2 class="notification-title" style="margin: 0px; padding: 15px 15px 15px 15px; text-align: center;">
            </h2>
          </div>
          <div class="col verify-content">
            <p class="notification-message" style="margin: 0px; padding: 30px 30px 30px 30px; font-size: 20px; text-align: center;">
            </p>
          </div>
        </div>
      </div>
    `
    );
  }
}

// if (!e.target.previousElementSibling.querySelector(".fa-times-circle")) {
//   e.target.previousElementSibling.classList.remove("sign-up-activated");
// }
// if (e.target.previousElementSibling.querySelector(".fa-check-circle")) {
//   e.target.previousElementSibling.classList.remove("sign-up-activated");
//   e.target.previousElementSibling.querySelector(".fas").classList.remove("fa-check-circle");
//   e.target.style.border = "none";
// this.tooltipPassword.querySelector(".funfact").innerHTML = "";

// this.tooltipPassword.querySelector(".strength").innerHTML = "";
// this.tooltipPassword.querySelector(".feedback").innerHTML = "";
// this.tooltipPassword.querySelector(".funfact").innerHTML = "";
// document.documentElement.style.setProperty("--progressBarColor", "rgba(197, 197, 197, 0)");
// this.progressBar.style.setProperty("--width", 0);

// e.target.style.backgroundColor = "rgb(238, 238, 238)";
// }

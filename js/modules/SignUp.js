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
      this.signUpForm = document.querySelector(".sign-up-form");
      this.signUpButton = document.querySelector(".sign-up-button");
      this.logInButton = document.querySelector("#log-in");
      this.dropdown = document.querySelectorAll(".dropdown");
      this.dropdownList = document.querySelectorAll(".dropdown .dropdown-menu li");
      this.progressBar = document.querySelector(".progress-bar");
      this.tooltipPassword = document.querySelector("#tippy-template");
      this.tooltipEmail = document.querySelector("#email-check-template");
      this.passwordVisibility = document.querySelector(".sign-up-password-check-icon");
      this.labelFirstName = document.querySelector(".label-first-name");
      this.labelLastName = document.querySelector(".label-last-name");
      this.labelEmail = document.querySelector(".label-email");
      this.labelPassword = document.querySelector(".label-password");
      this.labelConfirmPassword = document.querySelector(".label-confirm-password");
      this.labelDropdown1 = document.querySelector(".dropdown1");
      this.labelDropdown2 = document.querySelector(".dropdown2");
      this.inputBoxFirstName = document.querySelector("#inputBox-first-name");
      this.inputBoxLastName = document.querySelector("#inputBox-last-name");
      this.inputBoxEmail = document.querySelector("#inputBox-email");
      this.inputBoxPassword = document.querySelector("#inputBox-password");
      this.inputBoxConfirmPassword = document.querySelector("#inputBox-confirm-password");
      this.passwordStrength;
      this.feedbackMessage;
      this.funFactMessage;
      this.declareTooltips();
      this.events();
    });
  }

  //----------------------------Events----------------------------//
  events() {
    if (this.navSignUpButton) {
      this.navSignUpButton.addEventListener("click", () => this.openSignUpOverlay());
    }
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
    this.inputBoxFirstName.addEventListener("keydown", (e) => this.filterName(e));
    this.inputBoxFirstName.addEventListener("input", (e) => this.checkName(e));
    this.inputBoxLastName.addEventListener("keydown", (e) => this.filterName(e));
    this.inputBoxLastName.addEventListener("input", (e) => this.checkName(e));
    this.inputBoxPassword.addEventListener("keydown", (e) => this.filterPassword(e));
    this.inputBoxPassword.addEventListener("input", () => this.onChange());
    this.inputBoxConfirmPassword.addEventListener("input", () => this.checkPasswordSimilarity());
    this.inputBoxEmail.addEventListener("input", () => this.checkEmailValidity());
  }

  //----------------------------Methods----------------------------//
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
  }

  submit(e) {
    e.preventDefault();
    if (
      !this.labelFirstName.querySelector(".fa-times-circle") &&
      !this.labelLastName.querySelector(".fa-times-circle") &&
      !this.labelEmail.querySelector(".fa-times-circle") &&
      !this.labelPassword.querySelector(".fa-times-circle") &&
      !this.labelConfirmPassword.querySelector(".fa-times-circle") &&
      !this.labelDropdown1.querySelector(".fa-times-circle") &&
      !this.labelDropdown2.querySelector(".fa-times-circle")
    ) {
      this.signUpForm.submit();
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
      this.modalSignUp.classList.remove("animate__bounceInDown");
    }
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
      // e.target.style.backgroundColor = "rgb(225,225,225)";
    }
  }

  focusOut(e) {
    if (!e.target.value && e.target.previousElementSibling) {
      if (!e.target.previousElementSibling.querySelector(".fa-times-circle")) {
        e.target.previousElementSibling.classList.remove("sign-up-activated");
      }
      if (e.target.previousElementSibling.querySelector(".fa-check-circle")) {
        e.target.previousElementSibling.classList.remove("sign-up-activated");
        e.target.previousElementSibling.querySelector(".fas").classList.remove("fa-check-circle");
        e.target.style.border = "none";
      }
      this.tooltipEmail.querySelector(".validity").innerHTML = "";
      // e.target.style.backgroundColor = "rgb(238, 238, 238)";
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
    targetedList.parentNode.parentNode.querySelector("input").setAttribute("value", targetedList.getAttribute("id"));
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

  filterPassword(e) {
    if (e.keyCode == 32) e.preventDefault();
  }

  checkPasswordSimilarity() {
    clearTimeout(this.inputBoxConfirmPassword.timer);
    this.inputBoxConfirmPassword.timer = setTimeout(() => {
      if (
        this.inputBoxConfirmPassword.value == this.inputBoxPassword.value &&
        !this.labelConfirmPassword.querySelector(".fa-check-circle")
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
    this.feedbackMessage = this.inputBoxEmail.value.match(
      /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/g
    );

    clearTimeout(this.inputBoxEmail.timer);
    this.inputBoxEmail.timer = setTimeout(() => {
      if (this.feedbackMessage && !this.labelEmail.querySelector(".fa-check-circle")) {
        if (this.labelEmail.querySelector(".fa-times-circle")) {
          this.labelEmail.querySelector(".fas").classList.remove("fa-times-circle");
        }
        this.labelEmail.querySelector(".fas").classList.add("fa-check-circle");
        this.inputBoxEmail.style.border = "1.5px solid green";
        this.tooltipEmail.querySelector(".validity").innerHTML = "Email is valid";
        this.tooltipEmail.querySelector(".validity").style.color = "green";
      }
      if (!this.feedbackMessage) {
        if (this.labelEmail.querySelector(".fa-check-circle")) {
          this.labelEmail.querySelector(".fas").classList.remove("fa-check-circle");
        }
        this.labelEmail.querySelector(".fas").classList.add("fa-times-circle");
        this.inputBoxEmail.style.border = "1.5px solid red";
        this.tooltipEmail.querySelector(".validity").innerHTML = "Invalid email";
        this.tooltipEmail.querySelector(".validity").style.color = "red";
      }
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
            <form action="" class="container-fluid sign-up-form" autocomplete="off">
              <div class="row no-gutters">
                <div class="col text-left ml-5 pl-4 mb-1 mt-2">
                  <h1 class="font-weight-bolder">Sign Up</h1>
                </div>
              </div>
              <div class="row no-gutters">
                <div class="col text-right">
                  <label for="first-name" class="sign-up-label label-first-name"
                    >&nbsp; First Name &nbsp; <i class="fas "></i>
                  </label>
                  <input
                    type="text"
                    id="inputBox-first-name"
                    name="first-name"
                    class="sign-up-input-box"
                    onpaste="return false;"
                    required
                  />
                </div>
                <div class="col text-left">
                  <label
                    for="last-name"
                    class="sign-up-label label-last-name label-right"
                    >&nbsp; Last Name &nbsp; <i class="fas "></i></label
                  >
                  <input
                    type="text"
                    id="inputBox-last-name"
                    name="last-name"
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

                  <label for="email" class="sign-up-label label-email"
                    >&nbsp; Email &nbsp; <i class="fas "></i></label
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

                  <label for="password" class="sign-up-label label-password"
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
                    class="sign-up-label label-confirm-password label-right"
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
                  <label for="residential-college" class="dropdown-label dropdown1">
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
                    <label for="residential-college" class="dropdown-label dropdown2">
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
                <div class="col-4">
                  <button
                    class="sign-up-button mt-3 mb-2 font-weight-bold"
                  >
                    Sign Up
                  </button>
                </div>
                <div class="col-8">
                  <small id="have-account">
                    Already have an account?
                    <a id="log-in">Log In</a> <br />
                    <p>
                      By signing up, you agree to our
                      <a href="#" id="term-condition">Terms of Use</a> and
                      <a href="#" id="term-condition"> Privacy Policy</a>
                    </p>
                  </small>
                  <!-- <span id="typed"></span> -->
                  <!-- <div id="typed-strings">
                    <p style="display: none;">
                      By signing up, you agree to our
                      <a href="#" id="term-condition">Terms of Use</a> and
                      <a href="#" id="term-condition"> Privacy Policy</a>
                    </p>
                  </div> -->
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    `
    );
  }
}

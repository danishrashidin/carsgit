export default class LogIn {
  constructor() {
    this.injectHTML();
    document.addEventListener("DOMContentLoaded", () => {
      this.modalBackground = document.querySelector(".fade-background");
      //----------------------------SignUpComponent----------------------------//
      this.modalSignUp = document.querySelector(".shadowBox.sign-up");

      //----------------------------LogInComponent----------------------------//
      this.navLogInButton = document.querySelector("#button-log-in");
      this.modalLogIn = document.querySelector(".shadowBox.log-in");
      this.logInForm = document.querySelector(".log-in-form");
      this.passwordInputBox = document.querySelector(".log-in-input-password");
      this.passwordVisibility = document.querySelector(".log-in-password-check-icon");
      this.signUpButton = document.querySelector(".side-sign-up");
      this.forgotPassword = document.querySelector(".side-forgot-password");
      this.typed;
      this.events();
    });
  }

  //----------------------------Events----------------------------//
  events() {
    this.navLogInButton.addEventListener("click", (e) => this.openLogInOverlay(e));
    this.modalBackground.addEventListener("click", (e) => this.closeLogInOverlay(e));
    this.passwordInputBox.addEventListener("input", (e) => this.onChange());
    this.passwordVisibility.addEventListener("click", (e) => this.togglePasswordVisibility());
    this.logInForm.addEventListener("focusin", (e) => this.focusIn(e));
    this.logInForm.addEventListener("focusout", (e) => this.focusOut(e));
    this.signUpButton.addEventListener("click", (e) => this.slideOutlogIn(e));
  }

  //----------------------------Methods----------------------------//
  focusIn(e) {
    if (e.target == this.signUpButton || e.target == this.forgotPassword) return null;
    e.target.previousElementSibling.classList.add("log-in-label-activated");
    e.target.style.backgroundColor = "rgb(215, 215, 215)";
  }

  focusOut(e) {
    if (e.target == this.signUpButton || e.target == this.forgotPassword) return null;
    if (!e.target.value) {
      e.target.previousElementSibling.classList.remove("log-in-label-activated");
      e.target.style.backgroundColor = "rgb(238, 238, 238)";
    }
  }

  onChange() {
    if (!this.passwordInputBox.value) {
      this.passwordVisibility.classList.remove("fa-eye", "fa-eye-slash");
      this.passwordInputBox.type = "password";
    }
    if (this.passwordInputBox.value && this.passwordInputBox.type === "password") {
      this.passwordVisibility.classList.add("fa-eye-slash");
    }
  }

  togglePasswordVisibility() {
    this.passwordVisibility.classList.toggle("fa-eye-slash");
    this.passwordVisibility.classList.toggle("fa-eye");
    if (this.passwordInputBox.type === "password") {
      this.passwordInputBox.type = "text";
    } else {
      this.passwordInputBox.type = "password";
    }
  }

  openLogInOverlay(e) {
    document.querySelector("body").classList.add("stop-scrolling");
    this.modalLogIn.classList.add("animate__bounceInDown");
    this.modalBackground.style.display = "flex";
    this.modalLogIn.style.display = "block";
    this.typed = new Typed("#typed", {
      stringsElement: "#typed-strings",
      typeSpeed: 40,
    });

    setTimeout(() => {
      this.modalLogIn.classList.remove("animate__bounceInDown");
    }, 1000);
  }

  closeLogInOverlay(e) {
    if (e.target == this.modalBackground) {
      document.querySelector("body").classList.remove("stop-scrolling");
      this.modalBackground.style.display = "none";
      this.modalLogIn.style.display = "none";
      this.modalLogIn.classList.remove("animate__bounceInDown");
      this.typed.destroy();
      if (document.querySelector(".typed-cursor")) {
        document.querySelector("#typed").remove();
        document.querySelector(".typed-cursor").remove();
      }
      setTimeout(() => {
        document.querySelector("samp").innerHTML = `<span id="typed"></span>`;
      }, 100);
    }
  }

  slideOutlogIn(e) {
    this.modalLogIn.classList.add("animate__bounceOutDown");
    this.modalSignUp.classList.add("animate__bounceInDown");

    setTimeout(() => {
      this.modalSignUp.style.display = "block";
      setTimeout(() => {
        if (this.typed) {
          this.typed.destroy();
        }
        if (document.querySelector(".typed-cursor")) {
          document.querySelector("#typed").remove();
          document.querySelector(".typed-cursor").remove();
        }
        this.modalLogIn.classList.remove("animate__bounceOutDown");
        this.modalSignUp.classList.remove("animate__bounceInDown");
        this.modalLogIn.style.display = "none";
        document.querySelector("samp").innerHTML = `<span id="typed"></span>`;
      }, 1000);
    }, 490);
  }

  injectHTML() {
    document.body.insertAdjacentHTML(
      "beforeend",
      `<div class="fade-background animate__animated ">
      <div class="shadowBox log-in container-fluid animate__animated ">
        <div class="row no-gutters">
          <div class="col-sm-7 log-in-column-1">
            <form action="#" class="log-in-form">
              <div class="wrapper-up">
                <h1 id="log-in-title">Welcome Back</h1>
                <div id="typed-strings">
                  <p>To log in please enter your email and password</p>
                </div>
                <samp><span id="typed"></span></samp>
              </div>
              <div class="wrapper">
                <i class="fas fa-envelope log-in-icon"></i>
                <label for="email" class="log-in-label-email">
                  &nbsp; Email Address</label
                >
                <!-- <i class="fas fa-user-check email-check-icon"></i> -->
                <input
                  type="email"
                  id="email"
                  name="email"
                  class="log-in-input-email"
                  required
                />
              </div>
              <div class="wrapper">
                <i class="fas fa-key log-in-icon"></i>
                <label for="password" class="log-in-label-password"
                  >&nbsp; Password</label
                >

                <input
                  type="password"
                  id="password"
                  name="password"
                  class="log-in-input-password"
                  required
                />
                <i class="fas log-in-password-check-icon"></i>
              </div>
              <div class="wrapper">
                <button class="log-in-button d-block font-weight-bold">
                  Log In
                </button>
                <a tabindex="-1" class="side-sign-up">Sign Up?</a>
                <a href="#" class="side-forgot-password">Forgot Password</a>
              </div>
            </form>
          </div>
          <div class="col-sm-5 log-in-column-2">
            <div
              id="carouselLogIn"
              class="carousel slide"
              data-ride="carousel"
            >
              <ol class="carousel-indicators">
                <li
                  data-target="#carouselLogIn"
                  data-slide-to="0"
                  class="active"
                ></li>
                <li
                  data-target="#carouselLogIn"
                  data-slide-to="1"
                ></li>
                <li
                  data-target="#carouselLogIn"
                  data-slide-to="2"
                ></li>
                <li
                  data-target="#carouselLogIn"
                  data-slide-to="3"
                ></li>
              </ol>
              <div class="carousel-inner log-in-column-2">
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
        </div>
      </div>
    </div>
    `
    );
  }
}

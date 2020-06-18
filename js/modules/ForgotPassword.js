export default class ForgotPassword {
  constructor() {
    this.injectHTML();
    document.addEventListener("DOMContentLoaded", () => {
      this.modalBackground = document.querySelector(".fade-background");
      this.modalVerify = document.querySelector(".shadowBox.verify");
      this.modalForgotPassword = document.querySelector(".shadowBox-forgotPassword-sendMail");
      this.modalResetPassword = document.querySelector(".shadowBox.reset-password");
      this.forgotPasswordForm = document.querySelector(".forgotpassword-sendEmail-form");
      this.resetPasswordForm = document.querySelector(".reset-password-form");
      this.sendResetLinkButton = document.querySelector(".button-reset");
      this.resetPasswordButton = document.querySelector(".reset-password-button");
      this.tooltipEmailCheck = document.querySelector("#forgotPassword-email-check-template");
      this.tooltipPassword = document.querySelector("#tippy-template");
      this.progressBar = document.querySelector(".progress-bar");
      this.notificationTitle = document.querySelector(".notification-title");
      this.notificationMessage = document.querySelector(".notification-message");
      this.userVerified = document.querySelector(".--reset_Password");
      this.inputBoxNewPassword = document.querySelector(".reset-password-input-newPassword");
      this.inputBoxConfirmPassword = document.querySelector(".reset-password-input-confirmPassword");
      this.labelNewPassword = document.querySelector(".reset-password-label-newPassword");
      this.labelConfirmPassword = document.querySelector(".reset-password-label-confirmPassword");
      this.passwordVisibility = document.querySelector(".newPassword-check-icon");
      this.emailTippy;
      this.declareTooltips();
      this.events();
    });
  }

  //----------------------------Events----------------------------//
  events() {
    if (this.userVerified) this.popUpResetPasswordModal();
    this.forgotPasswordForm.addEventListener("submit", (e) => this.submitResetPasswordRequest(e));
    this.resetPasswordForm.addEventListener("submit", (e) => this.submitResetPassword(e));
    this.modalBackground.addEventListener("click", (e) => this.closeOverlay(e));
    this.resetPasswordForm.addEventListener("focusin", (e) => this.focusIn(e));
    this.resetPasswordForm.addEventListener("focusout", (e) => this.focusOut(e));
    this.inputBoxNewPassword.addEventListener("input", () => this.onChange());
    this.passwordVisibility.addEventListener("click", (e) => this.togglePasswordVisibility());
    this.inputBoxConfirmPassword.addEventListener("input", () => this.checkPasswordSimilarity());
  }

  //----------------------------Methods----------------------------//

  declareTooltips() {
    tippy(document.querySelector("#newPassword"), {
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

    this.emailTippy = tippy(document.querySelector(".forgot-email"), {
      theme: "red",
      content: document.getElementById("forgotPassword-email-check-template"),
      allowHTML: true,
      offset: [0, 15],
      placement: "right-start",
      arrow: true,
      arrowType: "sharp",
      animation: "scale",
      inertia: true,
      hideOnClick: false,
      trigger: "none",
    });
  }

  submitResetPasswordRequest(e) {
    e.preventDefault();
    this.sendResetLinkButton.innerHTML = `
    <div class="lds-ellipsis" style="width: 45px; height: 22px; left: -4px;">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    `;

    const formData = new FormData(this.forgotPasswordForm);
    fetch("resetPasswordHandler.php", {
      method: "post",
      body: formData,
    })
      .then((response) => {
        return response.json();
      })
      .then((emailCheck) => {
        if (emailCheck.status == "failed") {
          this.sendResetLinkButton.innerHTML = `Reset Password`;
          this.tooltipEmailCheck.querySelector(".email-error").innerHTML = emailCheck.emailError;
          this.emailTippy.show();
        }

        if (emailCheck.status == "success") {
          this.closeOverlay("closeForOtherPopUp");
          this.notificationTitle.innerHTML = `
          Password Reset Request
            `;
          this.notificationMessage.innerHTML = `
            <strong> Successfully  </strong>sent the password reset link to your SiswaMail!
            `;
          this.modalVerify.classList.add("animate__bounceInDown");
          this.modalVerify.style.display = "flex";
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }

  submitResetPassword(e) {
    e.preventDefault();
    if (
      this.labelNewPassword.querySelector(".fa-check-circle") &&
      this.labelConfirmPassword.querySelector(".fa-check-circle")
    ) {
      this.resetPasswordButton.innerHTML = `
      <div class="lds-ellipsis" style="width: 45px; height: 25px; left: -17px;">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
      `;

      const formData = new FormData(this.resetPasswordForm);
      fetch("resetPasswordHandler.php", {
        method: "post",
        body: formData,
      })
        .then((response) => {
          return response.json();
        })
        .then((updateQuery) => {
          if (updateQuery.status == "failed") {
            this.closeOverlay("closeForOtherPopUp");
            this.notificationTitle.innerHTML = `
            Password Reset
            `;
            this.notificationMessage.innerHTML = updateQuery.generalError;
            this.modalVerify.classList.add("animate__bounceInDown");
            this.modalVerify.style.display = "flex";
          }
          if (updateQuery.status == "success") {
            this.closeOverlay("closeForOtherPopUp");
            this.notificationTitle.innerHTML = `
            Password Reset
            `;
            this.notificationMessage.innerHTML = `
            <strong> Successfully  </strong> reset your password!
            `;
            this.modalVerify.classList.add("animate__bounceInDown");
            this.modalVerify.style.display = "flex";
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }
  }

  togglePasswordVisibility() {
    this.passwordVisibility.classList.toggle("fa-eye-slash");
    this.passwordVisibility.classList.toggle("fa-eye");
    if (this.inputBoxNewPassword.type === "password") {
      this.inputBoxNewPassword.type = "text";
    } else {
      this.inputBoxNewPassword.type = "password";
    }
  }

  onChange() {
    console.log(this.inputBoxNewPassword.value);
    console.log(this.inputBoxNewPassword.type);
    if (!this.inputBoxNewPassword.value) {
      this.passwordVisibility.classList.remove("fa-eye", "fa-eye-slash");
      this.inputBoxNewPassword.type = "password";
    }
    if (this.inputBoxNewPassword.value && this.inputBoxNewPassword.type === "password") {
      this.passwordVisibility.classList.add("fa-eye-slash");
    }

    if (this.inputBoxConfirmPassword.value) {
      clearTimeout(this.inputBoxConfirmPassword.timer);
      this.inputBoxConfirmPassword.timer = setTimeout(() => this.checkPasswordSimilarity(), 400);
    }

    this.passwordStrength = zxcvbn(this.inputBoxNewPassword.value);
    clearTimeout(this.inputBoxNewPassword.timer);
    this.inputBoxNewPassword.timer = setTimeout(() => {
      if (this.passwordStrength.score > 1 && !this.labelNewPassword.querySelector(".fa-check-circle")) {
        if (this.labelNewPassword.querySelector(".fa-times-circle")) {
          this.labelNewPassword.querySelector(".fas").classList.remove("fa-times-circle");
        }
        this.labelNewPassword.querySelector(".fas").classList.add("fa-check-circle");
        this.inputBoxNewPassword.style.border = "1.5px solid green";
      }
      if (this.passwordStrength.score < 2) {
        if (this.labelNewPassword.querySelector(".fa-check-circle")) {
          this.labelNewPassword.querySelector(".fas").classList.remove("fa-check-circle");
        }
        this.labelNewPassword.querySelector(".fas").classList.add("fa-times-circle");
        this.inputBoxNewPassword.style.border = "1.5px solid red";
      }
    }, 400);

    if (this.inputBoxNewPassword.value == "") {
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

  checkPasswordSimilarity() {
    clearTimeout(this.inputBoxConfirmPassword.timer);
    this.inputBoxConfirmPassword.timer = setTimeout(() => {
      if (
        this.inputBoxConfirmPassword.value == this.inputBoxNewPassword.value &&
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

  focusIn(e) {
    if (e.target == this.resetPasswordButton) return null;
    e.target.previousElementSibling.classList.add("reset-password-label-activated");
    e.target.style.backgroundColor = "rgb(215, 215, 215)";
  }

  focusOut(e) {
    if (e.target == this.resetPasswordButton) return null;
    if (!e.target.value && e.target.previousElementSibling) {
      e.target.previousElementSibling.classList.remove("reset-password-label-activated");
      e.target.style.backgroundColor = "rgb(238, 238, 238)";
      e.target.previousElementSibling.querySelector(".fas").classList.remove("fa-check-circle");
      e.target.previousElementSibling.querySelector(".fas").classList.remove("fa-times-circle");
      e.target.style.border = "none";
    }
  }

  popUpResetPasswordModal() {
    document.querySelector(".userEmail").value = this.userVerified.value;
    document.querySelector("body").classList.add("stop-scrolling");
    this.modalResetPassword.classList.add("animate__bounceInDown");
    this.modalBackground.style.display = "flex";
    this.modalResetPassword.style.display = "block";
  }

  closeOverlay(e) {
    if (e.target == this.modalBackground || e == "closeForOtherPopUp") {
      this.forgotPasswordForm.reset();
      this.resetPasswordForm.reset();
      this.modalVerify.style.display = "none";
      this.modalForgotPassword.style.display = "none";
      this.emailTippy.hide();
      this.sendResetLinkButton.innerHTML = `Reset Password`;
      this.resetPasswordButton.innerHTML = `Reset Password`;
      this.modalResetPassword.style.display = "none";
    }
  }

  injectHTML() {
    document.querySelector(".fade-background").insertAdjacentHTML(
      "beforeend",
      `
      <div class="shadowBox-forgotPassword-sendMail container-fluid animate__animated">
        <div class="row no-gutters forgotPassword-sendMail">
          <div class="col-md-3">
            <div class="row-pic">
              <img
                src="assets/forgotPassword.png"
                alt="I forgot my password image"
                id="forgot-password-image"
                class="col"
              />
            </div>
          </div>
          <div class="col-12 col-md-9" style="margin-bottom: auto; margin-top: auto;">
            <form class="forgotpassword-sendEmail-form" method="POST">
              <div class="row no-gutters">
                <p class="col-12 forgot-title">
                  Forgot <br />
                  Password?
                </p>
                <p class="col-12 forgot-description">
                  Idiot, don't worry! Just fill in your SiswaMail and we'll send you a link to reset your password.
                </p>
                <div id="forgotPassword-email-check-template" >
                    <p class="email-error" style ="max-width: 241px">
                    </p>
                </div>
                
                <input type="email" id="forgot-email" name="forgot-email" class="col-11 forgot-email" style="margin-top: 10px" required />
                <input type="hidden" name="action" value="send reset password">
                <button class="col-11 button-reset" style="margin-bottom: 15px;">Reset Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <div class="shadowBox reset-password container-fluid animate__animated">
        <div class="row no-gutters">
          <div class="col-sm-7 log-in-column-1">
            <form class="reset-password-form" method="POST">
              <div class="wrapper-up" style="margin-bottom: 20px;">
                <h1 id="reset-password-title">Reset Password</h1>
              </div>
              <div class="wrapper">
                <i class="fas fa-unlock new-password-icon"></i>


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

              
                <label for="password" class="reset-password-label-newPassword --reset"> &nbsp; New Password &nbsp; <i class="fas "></i></label>
                <input
                  type="password"
                  id="newPassword"
                  name="newPassword"
                  class="reset-password-input-newPassword"
                  required
                />
                <i class="fas newPassword-check-icon"></i>
              </div>
              <div class="wrapper">
                <i class="fas fa-lock new-password-icon"></i>
                <label for="password" class="reset-password-label-confirmPassword --reset">&nbsp; Confirm Password &nbsp; <i class="fas "></i></label>
                <input
                  type="password"
                  id="confirmPassword"
                  name="confirmPassword"
                  class="reset-password-input-confirmPassword"
                  required
                />
                <input type="hidden" name="action" value="update password">
                <input type="hidden" class="userEmail" name="userEmail" value="update password">
              </div>
              <div class="wrapper">
                <button class="reset-password-button d-block font-weight-bold" style="margin-top: 30px;">
                  Reset
                </button>
              </div>
            </form>
          </div>
          <div class="col-sm-5 log-in-column-2">
            <div id="carouselResetPassword" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselResetPassword" data-slide-to="0" class="active"></li>
                <li data-target="#carouselResetPassword" data-slide-to="1"></li>
                <li data-target="#carouselResetPassword" data-slide-to="2"></li>
                <li data-target="#carouselResetPassword" data-slide-to="3"></li>
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
    `
    );
  }
}

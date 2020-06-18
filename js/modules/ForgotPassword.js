export default class ForgotPassword {
  constructor() {
    this.injectHTML();
    document.addEventListener("DOMContentLoaded", () => {
      this.modalBackground = document.querySelector(".fade-background");
      this.forgotPasswordForm = document.querySelector(".forgotpassword-sendEmail-form");
      this.resetPasswordForm = document.querySelector(".reset-password-form");
      this.sendResetLinkButton = document.querySelector(".button-reset");
      this.resetPasswordButton = document.querySelector(".reset-password-button");
      this.tooltipEmailCheck = document.querySelector("#forgotPassword-email-check-template");
      this.emailTippy;
      this.declareTooltips();
      this.events();
    });
  }

  //----------------------------Events----------------------------//
  events() {
    this.forgotPasswordForm.addEventListener("submit", (e) => this.submit(e));
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
      offset: [0, 10],
      placement: "right-start",
      arrow: true,
      arrowType: "sharp",
      animation: "scale",
      inertia: true,
      hideOnClick: false,
      trigger: "none",
    });
  }

  submit(e) {
    // this.emailTippy.show();
    // this.tooltipEmailCheck.querySelector(
    //   ".email-error"
    // ).innerHTML = `The email address that you\'ve  entered  <span style="color:yellow">doesn\'t match any account.</span> Please try again and do a double check.`;

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
      .then((logInError) => {
        //   console.log(logInError);
        //   if (logInError.status == "success" && logInError.verified == 1) {
        //     window.location.href = "index.php?action=login-success&email=" + this.emailInputBox.value;
        //   } else if (logInError.status == "failed") {
        //     this.logInButton.innerHTML = `Log In`;
        //     if (logInError.emailError) {
        //       this.tooltipEmail.querySelector(".email-error").innerHTML = logInError.emailError;
        //       if (this.tooltipEmail.querySelector(".email-error").innerHTML) {
        //         this.emailTippy.show();
        //       }
        //     } else if (logInError.generalError) {
        //       this.tooltipEmail.querySelector(".email-error").innerHTML = logInError.generalError;
        //       if (this.tooltipEmail.querySelector(".email-error").innerHTML) {
        //         this.emailTippy.show();
        //       }
        //     }
        //   } else if (logInError.status == "success" && logInError.verified == 0) {
        //     this.userUnverifiedMessage(this.emailInputBox.value);
        //     this.closeLogInOverlay("closeForOtherPopUp");
        //   }
      })
      .catch((error) => {
        console.log(error);
      });
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
                <div id="forgotPassword-email-check-template">
                    <p class="email-error">
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

              
                <label for="password" class="reset-password-label-newPassword"> &nbsp; New Password</label>
                <input
                  type="newPassword"
                  id="newPassword"
                  name="newPassword"
                  class="reset-password-input-newPassword"
                  required
                />
                <i class="fas newPassword-check-icon"></i>
              </div>
              <div class="wrapper">
                <i class="fas fa-lock new-password-icon"></i>
                <label for="password" class="reset-password-label-confirmPassword">&nbsp; Confirm Password</label>
                <input
                  type="confirmPassword"
                  id="confirmPassword"
                  name="confirmPassword"
                  class="reset-password-input-confirmPassword"
                  required
                />
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

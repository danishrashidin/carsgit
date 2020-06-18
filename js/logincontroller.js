import LogIn from "./modules/LogIn.js";
import SignUp from "./modules/SignUp.js";
import ForgotPassword from "./modules/ForgotPassword.js";

if (document.querySelector("#button-log-in")) {
  new LogIn();
  new SignUp();
  new ForgotPassword();
}

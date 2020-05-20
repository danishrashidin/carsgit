import LogIn from "./modules/LogIn.js";
import SignUp from "./modules/SignUp.js";

if (document.querySelector("#button-log-in")) {
  new LogIn();
  new SignUp();
}

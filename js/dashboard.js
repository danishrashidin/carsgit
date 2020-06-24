// Set main margin
const navbar = document.querySelector("nav");
const dashboard = document.querySelector("main");

function init() {
  dashboard.style.top += navbar.offsetHeight + "px";
  console.log("Set : " + navbar.offsetHeight);
}

dashboard.onload = init();

function deleteConfirmation(id){
  var warning = 'Are you sure you want to delete account? There is no turning back!';
  var form = document.querySelector('delete-account');
  if(confirm(warning)){
    form.submit();
  } else {

  }
}
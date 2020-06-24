function openFolder(status) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(status).style.display = "block";
    evt.currentTarget.className += " active";
  }

document.querySelector(".AllApplications").addEventListener("click", function (e) { 
console.log(e.target);
openFolder('AllApplications')});
document.querySelector(".Pending").addEventListener("click", function(e) {openFolder('Pending')});
document.querySelector(".Completed").addEventListener("click", function(e) { openFolder('Completed')});
document.querySelector(".InProgress").addEventListener("click", function(e) { openFolder('InProgress')});

openFolder('AllApplications');
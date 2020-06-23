function GetDays() {
  var dropdt = new Date(document.getElementById("drop_date").value);
  var pickdt = new Date(document.getElementById("pick_date").value);
  var days = parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
  if (dropdt == "Invalid Date" || pickdt == "Invalid Date") return 0;
  else if (days < 0) return "Invalid date!";
  else return days;
}

function cal() {
  if (document.getElementById("drop_date")) {
    document.getElementById("numdays2").value = GetDays();
    document.getElementById("totalcost").value = cost();
  }

  function cost() {
    var dropdt = new Date(document.getElementById("drop_date").value);
    var pickdt = new Date(document.getElementById("pick_date").value);
    var cost = parseInt((dropdt - pickdt) / (24 * 3600 * 1000)) * 4;
    if (dropdt == "Invalid Date" || pickdt == "Invalid Date")
      return "RM0";
    else if (cost < 0) return "Invalid date!";
    else return "RM" + cost;
  }


  
}
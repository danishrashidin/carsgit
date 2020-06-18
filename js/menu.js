//hover effect
document.querySelector(".store-cart-icon").addEventListener("mouseover", function () {
  document.querySelector(".store-cart-icon").style.background = "#ff057c";
  document.querySelector(".n-items").style.color = "#321575";
})
document.querySelector(".store-cart-icon").addEventListener("mouseout", function () {
  document.querySelector(".store-cart-icon").style.background = "#321575";
  document.querySelector(".n-items").style.color = "#ff057c";
})


//show cart
document.querySelector(".store-cart-icon").addEventListener("click", function () {
  if (document.querySelector(".cart").style.visibility === "hidden" || document.querySelector(".cart").style.visibility === "") {
    document.querySelector(".cart").style.visibility = "visible";
    document.querySelector(".store-cart-icon").style.visibility = "hidden";
    document.querySelectorAll(".food-card").forEach(function (c) {
      var w = window.screen.width - 500;
      // console.log(w);
      c.style.maxWidth = w + "px";
      // console.log(c.style.maxWidth);
    })
  }
});


function close_cart() {
  document.querySelector(".cart").style.visibility = "hidden";
  document.querySelector(".store-cart-icon").style.visibility = "visible";
  document.querySelectorAll(".food-card").forEach(function (c) {
    var w = parseInt(c.style.maxWidth) + 300;
    // console.log(w);
    c.style.maxWidth = w + "px";
    // console.log(c.style.maxWidth);
  })
}

var cumulativeCartItems = [];
// const updatedCartItems = [];

// add items to the cart
(function () {
  const addBtn = document.querySelectorAll(".add-btn");
  addBtn.forEach(function (btn) {
    btn.addEventListener("click", function (event) {
      // console.log(event.target);
      if (event.target.classList.contains("add-btn")) {
        // console.log(event.target.parentElement.parentElement.previousElementSibling.children[0].textContent);
        const cart_item = {};
        let food_name = event.target.parentElement.parentElement.previousElementSibling.children[0].textContent
        var food_price = event.target.parentElement.previousElementSibling.textContent;
        var final_food_price = food_price.slice(3).trim();
        cart_item.food_name = food_name;
        cart_item.food_price = final_food_price;
        // console.log(cart_item);
        cumulativeCartItems.push(cart_item);
        // updatedCartItems.push(cart_item);
        // var i = countI() + 1;
        // console.log("i before remove: "+ i);
        var food_quantity = 0;
        for (var i = 0; i < cumulativeCartItems.length; i++) {
          if (cumulativeCartItems[i].food_name == cart_item.food_name) {
            food_quantity += 1;
            // cart_item.food_price+=final_food_price;
          }
        }

        if (food_quantity > 1) {
          // console.log(document.querySelectorAll(".item-title")[document.querySelectorAll(".item-title").length-1]);
          document.querySelectorAll(".item-title").forEach(function (cI) {
            if (cI.textContent === cart_item.food_name) {
              // console.log(cI.parentElement.parentElement);
              // cI.parentElement.parentElement.style.padding = 0;
              cI.parentElement.parentElement.remove();
            }
            // console.log("i after remove: "+ i);
            // for(var j=0;j<updatedCartItems.length;j++){
            // if(cI.textContent === updatedCartItems[j]){
            //   delete updatedCartItems[j];

            // }
            // }
          })
        }
        // console.log("i if after remove: "+ i);


        /* 
          <div class="cart-item">
              <div class="item-text">
                  <div class="item-title"><b>Food name here</b></div>
                  <input type="hidden" name="food-name- + i" value="food name here">
                  <div class="item-quantity">RM 00.00</div>
                  <input type="hidden" name="food-quantity- + i" value="food_quantity">
                  <div class="item-price" name="food-price" value ="food price" >RM 00.00</div>
                  <input type="hidden" name="food-price- + i" value="food_price * food quantity">
                  <input type="hidden" name="count" value="i">
                  <div class="store-remove-icon" value="delete"><i class="fa fa-trash"></i></div>
              </div>
           </div>
           <input type="hidden" name="" value="">
        */
        const create_cart_item = document.createElement("div");
        create_cart_item.classList.add("cart-item");
        // var i = countI();
        create_cart_item.innerHTML =
          "<div class" + "=" + 'item-text' + ">" +
          "<div class" + "=" + 'item-title' + "><b>" + cart_item.food_name + "</b></div>" +
          // "<input type" + "=" + 'hidden' + " name" + "=" + "'food-name-" + i + "'" + " value" + "='" + cart_item.food_name + "'>" +
          "<div class" + "=" + 'item-quantity' + ">" + food_quantity + "</div>" +
          // "<input type" + "=" + 'hidden' + " name" + "=" + "'food-quantity-" + i + "'" + " value" + "='" + food_quantity + "'>" +
          "<div class" + "=" + 'item-price' + ">" + (cart_item.food_price * food_quantity).toFixed(2) + "</div>" +
          // "<input type" + "=" + 'hidden' + " name" + "=" + "'food-price-" + i + "'" + " value" + "='" + (cart_item.food_price * food_quantity).toFixed(2) + "'>" +
          // "<input type" + "=" + 'hidden' + " name" + "=" + "count" + " value" + "='" + i + "'>" +
          "<div class" + "=" + 'store-remove-icon' + " value" + "=" + 'delete' + "><i class" + "=" + "\"fa fa-trash\"" + "></i>" +
          "</div>";
        // console.log(create_cart_item);


        // select cart
        const cart = document.querySelector(".cart");
        const total = document.querySelector(".cart-total");
        cart.insertBefore(create_cart_item, total);
        alert("\"" + cart_item.food_name + "\"" + " has been added to the cart.");
        total.innerHTML = "(Total) RM " + showTotals().toFixed(2);
        const n = document.querySelectorAll(".n-items");
        for (var x = 0; x < n.length; x++) {
          n[x].innerHTML = countItems();
        }
      }


      // document.querySelectorAll(".fa-trash").forEach(function (btn) {
      //   btn.addEventListener("click", function (event) {
      //     var temp = event.target.parentElement.parentElement.children[0].textContent;
      //     console.log(temp);
      //     // event.target.parentElement.parentElement.parentElement.style.padding = 0;
      //     event.target.parentElement.parentElement.parentElement.remove();

      //     // console.log(cumulativeCartItems);
      //     const total = document.querySelector(".cart-total");
      //     total.innerHTML = "(Total) RM " + showTotals().toFixed(2);
      //     const n = document.querySelectorAll(".n-items");
      //     for (var x = 0; x < n.length; x++) {
      //       n[x].innerHTML = countItems();
      //     }
      //   })

      // })
      // var j = cumulativeCartItems.length - 1;
      // while (j >= 0) {
      //   // console.log(cumulativeCartItems[j].food_name);
      //   var k = cumulativeCartItems[j].food_name;
      //   if (temp == k) {
      //     cumulativeCartItems.pop();

      //   } else {
      //     j--;
      //   }
      //   j--;
      // }

      var temp;
      //put inside here to remove new added item
      (function removeItem() {
        const removeBtn = document.querySelectorAll(".store-remove-icon");
        removeBtn.forEach(function (btn) {
          btn.addEventListener("click", function (event) {
            if (event.target.classList.contains("fa-trash")) {
              temp = event.target.parentElement.parentElement.children[0].textContent;
              console.log(temp);
              // event.target.parentElement.parentElement.parentElement.style.padding = 0;
              event.target.parentElement.parentElement.parentElement.remove();
              for (var j = 0; j < cumulativeCartItems.length; j++) {
                if (temp == cumulativeCartItems[j].food_name) {
                  // cumulativeCartItems.splice(j, j+1);
                  cumulativeCartItems[j]="";
                }
              }
              // console.log(cumulativeCartItems);
              const total = document.querySelector(".cart-total");
              total.innerHTML = "(Total) RM " + showTotals().toFixed(2);
              const n = document.querySelectorAll(".n-items");
              for (var x = 0; x < n.length; x++) {
                n[x].innerHTML = countItems();
              }
            }
          })
        })
        // var j = cumulativeCartItems.length - 1;
        // while (j >= 0) {
        //   // console.log(cumulativeCartItems[j].food_name);
        //   var k = cumulativeCartItems[j].food_name;
        //   if (temp === k) {
        //     cumulativeCartItems.pop();

        //   } else {
        //     j--;
        //   }
        //   j--;
        // }
      }());

    })
  })
})();

// document.querySelector(".cart-btn").addEventListener("click", function () {
//   alert("test");
//   const create_hidden_input = document.createElement("div");
//   create_hidden_input.classList.add("order-output");
//   var i=countI();
//   for(var a = 1; a<=i ; a++){
//   create_hidden_input.innerHTML = 
//   "<div>" + 
//       "<input type" + "=" + 'hidden' + " name" + "=" + "'food-name-" + i + "'" + " value" + "='" + cart_item.food_name + "'>" +
//       "<input type" + "=" + 'hidden' + " name" + "=" + "'food-quantity-" + i + "'" + " value" + "='" + food_quantity + "'>" +
//       "<input type" + "=" + 'hidden' + " name" + "=" + "'food-price-" + i + "'" + " value" + "='" + (cart_item.food_price * food_quantity).toFixed(2) + "'>" +
//       "<input type" + "=" + 'hidden' + " name" + "=" + "count" + " value" + "='" + i + "'>" +
//   "</div>";
//   }

// })

//show totals 
function showTotals() {
  var sum = 0;
  const items = document.querySelectorAll(".item-price");
  for (var i = 0; i < items.length; i++) {
    sum += parseFloat(items[i].textContent);
  }
  // console.log(sum);
  return sum;
}

//count n-items 
function countItems() {
  var qtt = 0;
  const num = document.querySelectorAll(".item-quantity");
  num.forEach(function (cI) {
    qtt += parseInt(cI.textContent);
  })
  return qtt;
}

// count i
function countI() {
  const num = document.querySelectorAll(".cart-item");
  return num.length + 1;
}

//click order
function order_function() {
  if (showTotals() == 0) {
    // alert("Your cart is empty!");
  } else if (confirm("Total price to be paid is RM " + showTotals().toFixed(2) + ".\n\nOnce the order has been made, it cannot be undone. \n\nChoose 'PRE-ORDER' button if you want to make order for future.\n\nClick 'OK' to confirm order.") == true) {
    var rows = document.querySelectorAll(".cart-item");
    for (var r = 0; r < rows.length; r++) {
      var name = rows[r].children[0].children[0].textContent;
      var quantity = rows[r].children[0].children[1].textContent;
      var price = rows[r].children[0].children[2].textContent;

      const create_hidden_input = document.createElement("div");
      create_hidden_input.classList.add("order-output");
      var i = r + 1;
      create_hidden_input.innerHTML =
        "<input type" + "=" + 'hidden' + " name" + "=" + "'food-name-" + i + "'" + " value" + "='" + name + "'>" +
        "<input type" + "=" + 'hidden' + " name" + "=" + "'food-quantity-" + i + "'" + " value" + "='" + quantity + "'>" +
        "<input type" + "=" + 'hidden' + " name" + "=" + "'food-price-" + i + "'" + " value" + "='" + price + "'>" +
        "<input type" + "=" + 'hidden' + " name" + "=" + "count" + " value" + "='" + rows.length + "'>";
      document.querySelector(".cart").appendChild(create_hidden_input);
    }
  }
}

//click preorder
function preorder_function() {
  if (showTotals() == 0) {
    // alert("Your cart is empty!");
  } else if (confirm("Total price to be paid is RM " + showTotals().toFixed(2) + ".\nYou are heading to PRE-ORDER process. \n\nChoose 'ORDER' button to make order for TODAY.\n\nClick 'OK' to confirm order.") == true) {
    // alert("Heading to proceed PRE-ORDER.");
    var date = new Date;
    var int_today = Number(formatDate(date));
    var limit_date = int_today + 14;
    const create_hidden_input = document.createElement("div");
    create_hidden_input.classList.add("order-output");
    create_hidden_input.innerHTML =
      "<input type" + "=" + 'hidden' + " name" + "=" + "InvalidDate" + " value" + "='" + 1 + "'>";
    document.querySelector(".cart").appendChild(create_hidden_input);
    date = prompt("Enter pick up date (year/month/day) e.g. 2020/12/30 \n(*Please enter date not further than 2 weeks from today.)", "yyyy/mm/dd");
    var int_date = Number(date.split("/").join(""));
    // console.log(int_date);
    if (date != "") {
      if (checkDate(date) == true) {
        if (int_date < limit_date && int_date > int_today) {
          var rows = document.querySelectorAll(".cart-item");
          for (var r = 0; r < rows.length; r++) {
            var name = rows[r].children[0].children[0].textContent;
            var quantity = rows[r].children[0].children[1].textContent;
            var price = rows[r].children[0].children[2].textContent;

            const create_hidden_input = document.createElement("div");
            create_hidden_input.classList.add("order-output");
            var i = r + 1;
            create_hidden_input.innerHTML =
              "<input type" + "=" + 'hidden' + " name" + "=" + "'food-name-" + i + "'" + " value" + "='" + name + "'>" +
              "<input type" + "=" + 'hidden' + " name" + "=" + "'food-quantity-" + i + "'" + " value" + "='" + quantity + "'>" +
              "<input type" + "=" + 'hidden' + " name" + "=" + "'food-price-" + i + "'" + " value" + "='" + price + "'>" +
              "<input type" + "=" + 'hidden' + " name" + "=" + "count" + " value" + "='" + rows.length + "'>" +
              "<input type" + "=" + 'hidden' + " name" + "=" + "pre-order-date" + " value" + "='" + date + "'>" +
              "<input type" + "=" + 'hidden' + " name" + "=" + "InvalidDate" + " value" + "='" + 0 + "'>";

            document.querySelector(".cart").appendChild(create_hidden_input);
          }
        } else {
          alert("The date is invalid. You can only make pre-order for tomorrow to 2 weeks later only.");
          preorder_function();

        }
      } else {
        alert("The date is invalid. \nPlease enter a valid date follow format (yyyy/mm/dd).");
        preorder_function();
      }

    } else {
      alert("You didn't enter the date.");
      preorder_function();
    }
  }
}

function onOrderedMessage() {
  document.getElementById("overlayOrderedMessage").style.display = "block";
}

function offOrderedMessage() {
  document.getElementById("overlayOrderedMessage").style.display = "none";
}

function onPreOrderedMessage() {
  document.getElementById("overlayPreOrderedMessage").style.display = "block";
}

function offPreOrderedMessage() {
  document.getElementById("overlayPreOrderedMessage").style.display = "none";
}

function onCartEmptyMessage() {
  document.getElementById("overlayCartEmptyMessage").style.display = "block";
}

function offCartEmptyMessage() {
  document.getElementById("overlayCartEmptyMessage").style.display = "none";
}

function onDateInvalidMessage() {
  document.getElementById("overlayDateInvalidMessage").style.display = "block";
}

function offFoundMessage() {
  document.getElementById("overlayFoundMessage").style.display = "none";
}

function onFoundMessage() {
  document.getElementById("overlayFoundMessage").style.display = "block";
}

function offSearchEmptyMessage() {
  document.getElementById("overlaySearchEmptyMessage").style.display = "none";
}

function onSearchEmptyMessage() {
  document.getElementById("overlaySearchEmptyMessage").style.display = "block";
}

function offNotFoundMessage() {
  document.getElementById("overlayNotFoundMessage").style.display = "none";
}

function onNotFoundMessage() {
  document.getElementById("overlayNotFoundMessage").style.display = "block";
}

function formatDate(date) {
  var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

  if (month.length < 2)
    month = '0' + month;
  if (day.length < 2)
    day = '0' + day;

  return [year, month, day].join('');
}

function checkDate(field) {
  var minYear = (new Date()).getFullYear();

  // regular expression to match required date format
  var re = /^(\d{4})\/(\d{1,2})\/(\d{1,2})$/;

  if (regs = field.match(re)) {
    if (regs[1] == minYear || regs[1] == minYear + 1) {
      if (regs[2] >= 1 && regs[2] <= 12) {
        if (regs[3] >= 1 && regs[3] <= 31) {
          return true;
        }
      }
    }
  }

  return false;
}


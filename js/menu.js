// console.log(document.querySelector("title").textContent);

//show cart
if (document.querySelector("title").textContent === "Food - Menu") {
  (function () {
    document.querySelector(".cart").style.visibility = "hidden";
    document.querySelector(".sticky-cart").addEventListener("click", function () {
      if (document.querySelector(".cart").style.visibility === "hidden") {
        document.querySelector(".cart").style.visibility = "visible";
        document.querySelector(".sticky-cart").style.visibility = "hidden";
      }
      else {
        document.querySelector(".cart").style.visibility = "hidden";
        document.querySelector(".sticky-cart").style.visibility = "visible";
      }
    });

  })();
}

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
        console.log(cart_item);


        /* <div class="cart-item">
              <div class="item-text">
                  <div class="item-title"><b>Food name here</b></div>
                  <div class="item-price">RM 00.00</div>
                  <div class="store-remove-icon"><i class="fa fa-trash"></i></div>
              </div>
           </div>
        */
        const create_cart_item = document.createElement("div");
        create_cart_item.classList.add("cart-item");
        create_cart_item.innerHTML =
          "<div class" + "=" + 'item-text' + ">" +
          "<div class" + "=" + 'item-title' + "><b>" + cart_item.food_name + "</b></div>" +
          "<div class" + "=" + 'item-price' + ">" + cart_item.food_price + "</div>" +
          "<div class" + "=" + 'store-remove-icon' + "><i class" + "=" + "\"fa fa-trash\"" + "></i>" +
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

      //put inside here to remove new added item
      (function removeItem() {
        const removeBtn = document.querySelectorAll(".store-remove-icon");
        removeBtn.forEach(function (btn) {
          btn.addEventListener("click", function (event) {
            if (event.target.classList.contains("fa-trash")) {
              event.target.parentElement.parentElement.parentElement.style.padding = 0;
              event.target.parentElement.parentElement.remove();
              const total = document.querySelector(".cart-total");
              total.innerHTML = "(Total) RM " + showTotals().toFixed(2);
              const n = document.querySelectorAll(".n-items");
              for (var x = 0; x < n.length; x++) {
                n[x].innerHTML = countItems();
              }
            }
          })
        })
      }());

    })
  })
})();

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
  const num = document.querySelectorAll(".item-title");
  return num.length;
}

//click order
function order_function() {
  if (confirm("Total price to be paid is RM " + showTotals().toFixed(2) + ".\n\nOnce the order has been made, it cannot be undone. \n\nChoose 'PRE-ORDER' button if you want to make order for future.\n\nClick 'OK' to confirm order.") == true) {
    alert("Order submitted. Please pick up your food from related store by TODAY. \n\nYou can view your order status at \"MY ORDER\".");
    // const cart = document.querySelector(".cart");
    // cart.removeChild();
  }
}

//click preorder
function preorder_function() {
  if (confirm("Total price to be paid is RM " + showTotals().toFixed(2) + ".\nYou are heading to PRE-ORDER process. \n\nChoose 'ORDER' button to make order for TODAY.\n\nClick 'OK' to confirm order.") == true) {
    alert("Heading to proceed PRE-ORDER.");
    var date = prompt("Choose pick up date (month/day/year) e.g. 12/09/2020 \n(*Please enter date not further than 2 weeks from today.)");
    if (date != "")
      alert("Your PRE-ORDER on " + date + " has been submitted. You can view or edit your pre-order at \"MY PRE-ORDER\".");
      else
      alert("You didn't enter the date.");
  }
}
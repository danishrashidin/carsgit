<link rel="stylesheet" type="text/css" href="css/food.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
<!-- for search icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="food-body">

  <header class="description">
    <div class="main-container">

      <h1> My Pre-order </h1>
      <!-- use form to go to search food -->
      <form method="GET" action="mypreorder.php">
        <div class="search-container">
          <input type="text" placeholder="Search food..." name="search">
          <button type="submit"><i class="fa fa-search"></i></button>
        </div>
      </form>

    </div>
  </header>
  <div class="overlayMessage" id="overlayFoundMessage" onclick="offFoundMessage()" title="Click anywhere to close this window">
    <div id="Message" style="color: 200; " }>Found!<table id="foundMessage">
        <tr>
          <th>Food Name</th>
          <th>Restaurant Name</th>
        </tr>
      </table>
    </div>
  </div>
  <div class="overlayMessage" id="overlayNotFoundMessage" onclick="offNotFoundMessage()" title="Click anywhere to close this window">
    <div id="Message">Sorry, food not found.</div>
  </div>
  <div class="overlayMessage" id="overlaySearchEmptyMessage" onclick="offSearchEmptyMessage()" title="Click anywhere to close this window">
    <div id="Message">You did not enter any key. </div>
  </div>

  <!--  NAVIGATION  -->
  <div class="main-nav">
    <ul>
      <li>
        <a href="dashboard.php?page=myorder">my order</a>
      </li>
      <li>
        <a href="dashboard.php?page=mypreorder" class="active">my pre-order</a>
      </li>
      <li>
        <a href="dashboard.php?page=orderhistory">order history</a>
      </li>
    </ul>
  </div>
  <!--  NAVIGATION END  -->

  <div>

    <?php
    include_once "config.php";
    $student_id = 1; //assume 1st;
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $today = date("Y/m/d");
    $intToday = intval(str_replace("/", "", $today));

    $sql5 = "SELECT Pickup_Date FROM foodorder WHERE Pickup_Date>$intToday GROUP BY Pickup_Date ORDER BY Pickup_Date";
    $result5 = $connectionString->query($sql5);
    while ($date = $result5->fetch_array()) {
      $pickup_date = str_replace('-', '/', $date['Pickup_Date']);
      $intPickup_date = intval(str_replace("/", "", $pickup_date));

    ?>

      <div class="horizontal-bar-row">
        <div>
          <p style="float:right">&nbsp&nbspto pick up date</p>
          <p id="countDownTimer" style="color:grey; float:right"><?php echo $intPickup_date - $intToday ?> day(s)</p>
          <h2><?php echo $pickup_date ?>&nbsp</h2>


        </div>
      </div>

      <?php
      $sql = "SELECT Count(Food_ID), Order_No FROM foodorder WHERE Student_ID = $student_id and Pickup_Date = '$pickup_date' and Order_Status='Pre-Order' GROUP BY Order_No ORDER BY Pickup_Date";
      $result = $connectionString->query($sql);
      while ($row = $result->fetch_array()) {
        $n = $row['Count(Food_ID)'];
        $order_no = $row['Order_No'];

      ?>

        <?php $sql2 = "SELECT restaurant.Restaurant_Name,foodorder.Pickup_Date FROM (foodorder INNER JOIN food ON food.Food_ID = foodorder.Food_ID) INNER JOIN restaurant ON restaurant.Restaurant_ID = food.restaurant_ID WHERE Order_No = '$order_no' ORDER BY Pickup_Date";
        $result2 = $connectionString->query($sql2);
        while ($res = $result2->fetch_array()) {
          $res_name = $res['Restaurant_Name'];
          // $pickup_date = str_replace('-', '/', $res['Pickup_Date']);
        }
        ?>

        <div class="receipt-container">
          <div class="receipt-card">
            <div class="store-remove-icon" id="delete" value="delete"><i class="fa fa-trash" style="font-size: x-large; "></i></div>
            <a href="#" title="Order ID" style="font-weight: lighter ;color: rgb(119, 119, 119);"><?php echo $order_no ?></a>
            <br>
            <br>
            <h4 style="text-align: center; padding-bottom: 25px; color: #321575;"><?php echo strtoupper($res_name) ?></h4>
            <p style="text-decoration: underline; ">Food Name<span class="quantity" style="color: black;">Quantity</span><span class="price" style="color: black;">RM</span></p>

            <?php
            $sql3 = "SELECT food.Food_Name,foodorder.Quantity,foodorder.Total_Price FROM foodorder INNER JOIN food ON food.Food_ID = foodorder.Food_ID WHERE Order_No = '$order_no' ORDER BY Order_ID";
            $result3 = $connectionString->query($sql3);
            $total_price = 0;
            while ($order = $result3->fetch_array()) {
              $food_name = $order['Food_Name'];
              $food_quantity = $order['Quantity'];
              $food_price = $order['Total_Price'];

              $total_price += $food_price;

            ?>

              <p class="fname"><?php echo $food_name ?> <span class="quantity"><?php echo $food_quantity ?></span><span class="price"><?php echo $food_price ?></span></p>

            <?php

            }
            ?>
            <hr>
            <p>Total payment to be paid<span class="quantity"></span><span class="price" style="color:black"><b>RM <?php echo number_format($total_price, 2) ?></b></span></p>
          </div>
        </div>

      <?php
      }
    }

    if (isset($_GET['delete']) == true) {
      $delete_ID = $_GET['delete'];
      $sql4 = "DELETE FROM foodorder WHERE Order_No='$delete_ID'";
      if ($connectionString->query($sql4) == true) {
      ?>
        <script>
          alert("Order with Order_No <?php echo $delete_ID ?> have been successfully deleted .");
          location.assign("mypreorder.php");
        </script>

    <?php
        // echo "Order with Order_No $delete_ID have been deleted successfully.";
      } else {
        echo "Error: " . $sql4 . "<br>" . $connectionString->error;
      }
    }

    // $connectionString->close();
    ?>

  </div>
  <p style="text-align: center; color: rgb(119, 119, 119);">You've seen all your orders.</p>


</div>

<script>
  document.querySelectorAll('#delete').forEach(function(del) {
    del.addEventListener("click", function() {
      if (confirm('Are you sure you want to delete your Pre-order with ID <?php echo $order_no ?>?')) {
        location.assign("mypreorder.php?delete=<?php echo $order_no ?>");
      }
    });
  });
</script>
<script type="text/javascript" src="js/menu.js"></script>

</div>
<?php
include_once("searchFilterFood.php");
?>
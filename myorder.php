<link rel="stylesheet" type="text/css" href="css/food.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<!-- for search icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />

<div id="food-body">
  <header class="description">
    <div class="main-container">

      <h1> My Order </h1>
      <!-- use form to go to search food -->
      <form method="GET" action="dashboard.php">
        <div class="search-container">
          <input type="hidden" name="page" value="myorder">
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
        <a href="dashboard.php?page=myorder" class="active">my order</a>
      </li>
      <li>
        <a href="dashboard.php?page=mypreorder">my pre-order</a>
      </li>
      <li>
        <a href="dashboard.php?page=orderhistory">order history</a>
      </li>
    </ul>
  </div>
  <!--  NAVIGATION END  -->

  <div>
    <div class="horizontal-bar-row">
      <div>
        <h2>Today&nbsp<span style="color:#321575">
            <script>
              document.write(new Date().toLocaleDateString());
            </script>
          </span>
        </h2>
      </div>
    </div>
    <?php
    include_once "config.php";
    $student_id = $_SESSION['Student_ID'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $today = date("Y/m/d");

    $sql = "SELECT Count(Food_ID), Order_No FROM foodorder WHERE Student_ID = $student_id and Order_Date='$today' and Order_Status='Order' GROUP BY Order_No ORDER BY Order_No DESC";
    $result = $connection->query($sql);
    while ($row = $result->fetch_array()) {
      $n = $row['Count(Food_ID)'];
      $order_no = $row['Order_No'];

      $sql2 = "SELECT restaurant.Restaurant_Name FROM (foodorder INNER JOIN food ON food.Food_ID = foodorder.Food_ID) INNER JOIN restaurant ON restaurant.Restaurant_ID = food.restaurant_ID WHERE Order_No = '$order_no' ORDER BY Order_ID";
      $result2 = $connection->query($sql2);
      while ($res = $result2->fetch_array()) {
        $res_name = $res['Restaurant_Name'];
      }
    ?>

      <div class="receipt-container">
        <div class="receipt-card">
          <a href="#" title="Order ID" style="font-weight: lighter ;color: rgb(119, 119, 119);"><?php echo $order_no ?></a>
          <br>
          <br>
          <h4 style="text-align: center; padding-bottom: 25px; color: #321575;"><?php echo strtoupper($res_name) ?></h4>
          <p style="text-decoration: underline; ">Food Name<span class="quantity" style="color: black;">Quantity</span><span class="price" style="color: black;">RM</span></p>

          <?php
          $sql3 = "SELECT food.Food_Name,foodorder.Quantity,foodorder.Total_Price FROM foodorder INNER JOIN food ON food.Food_ID = foodorder.Food_ID WHERE Order_No = '$order_no' ORDER BY Order_ID";
          $result3 = $connection->query($sql3);
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
    // $connection->close();
    ?>

    <p style="text-align: center; color: rgb(119, 119, 119);">You've seen all your orders.</p>

  </div>
</div>
<script type="text/javascript" src="js/menu.js"></script>

<?php
include_once("searchFilterFood.php");
?>
<link rel="stylesheet" type="text/css" href="css/food.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
<!-- for search icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="food-body">
  <header class="description">
    <div class="main-container">

      <h1> Order History </h1>
      <!-- use form to go to search food -->
      <form method="GET" action="orderhistory.php">
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
        <a href="dashboard.php?page=mypreorder">my pre-order</a>
      </li>
      <li>
        <a href="dashboard.php?page=orderhistory" class="active">order history</a>
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

    $sql5 = "SELECT Pickup_Date AS Date FROM foodorder WHERE Pickup_Date>0 AND Pickup_Date<$intToday
    UNION
    SELECT Order_Date FROM foodorder WHERE Order_Date>0 AND Order_Date<$intToday
    ORDER BY Date DESC";
    $result5 = $connectionString->query($sql5);
    while ($date = $result5->fetch_array()) {
      $union_date = str_replace('-', '/', $date['Date']);
      $intDate = intval(str_replace("/", "", $union_date));

    ?>

      <div class="horizontal-bar-row">
        <div>
          <p style="float:right">&nbsp&nbspago</p>
          <p id="countDownTimer" style="color:grey; float:right"><?php echo $intToday - $intDate ?> day(s)</p>
          <h2><?php echo $union_date ?>&nbsp</h2>


        </div>
      </div>

      <?php
      $sql = "SELECT Count(Food_ID), Order_No FROM foodorder WHERE Student_ID = $student_id and (Pickup_Date = '$union_date' OR Order_Date = '$union_date') GROUP BY Order_No ORDER BY Order_No";
      $result = $connectionString->query($sql);
      while ($row = $result->fetch_array()) {
        $n = $row['Count(Food_ID)'];
        $order_no = $row['Order_No'];

      ?>

        <?php $sql2 = "SELECT restaurant.Restaurant_Name,foodorder.Pickup_Date FROM (foodorder INNER JOIN food ON food.Food_ID = foodorder.Food_ID) INNER JOIN restaurant ON restaurant.Restaurant_ID = food.restaurant_ID WHERE Order_No = '$order_no' ORDER BY Order_No";
        $result2 = $connectionString->query($sql2);
        while ($res = $result2->fetch_array()) {
          $res_name = $res['Restaurant_Name'];
          // $pickup_date = str_replace('-', '/', $res['Pickup_Date']);
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
    ?>

    <p style="text-align: center; color: rgb(119, 119, 119);">You've seen all your orders.</p>

  </div>
</div>
<script type="text/javascript" src="js/menu.js"></script>

<?php
include_once("searchFilterFood.php");
?>
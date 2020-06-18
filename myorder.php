<!DOCTYPE html>
<html>

<head id="food-head">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Food - My Order</title>
  <link rel="stylesheet" type="text/css" href="css/food.css">
  <link rel="stylesheet" type="text/css" href="css/menu.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <!-- for search icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
  <link rel="stylesheet" href="css/login.css" />

</head>



<body id="food-body">
  <!-- Navigation bar -->
  <nav class="navbar-expand-lg transitive" id="navbar">
    <!-- Nav Container -->
    <div class="nav-container transitive" id="nav-container">
      <!-- Home brand -->
      <a class="" href="index.php" style="float: left; padding: 0;">
        <img src="" height="30px" alt="" />
        College Activity Registration System
      </a>

      <!-- Menus -->
      <div class="menu" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item active px-4">
            <a class="nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item px-4">
            <a class="nav-link" href="activity.php">ACTIVITIES</a>
          </li>
          <li class="nav-item px-4">
            <a class="nav-link" href="food.php">FOOD</a>
          </li>
          <li class="nav-item px-4">
            <a class="nav-link" href="application.php">ACCOMMODATION</a>
          </li>
          <li class="nav-item px-4" style="margin-right: 64px;">
            <a class="nav-link" href="report.php">REPORT</a>
          </li>

          <!-- two buttons -->
          <li class="nav-item">
            <button type="button" class="btn nav-btn px-4 py-2" style="background-color: #00df89; border-color: #00df89;">
              CONTACT US
            </button>
          </li>
          <li class="nav-item">
            <button type="button" id="button-log-in" class="btn btn-outline-light nav-btn px-4 py-2">
              LOGIN
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="description">
    <div class="main-container">

      <h1> My Order </h1>
      <!-- use form to go to search food -->
      <form method="GET" action="myorder.php">
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
        <a href="myorder.php" class="active">my order</a>
      </li>
      <li>
        <a href="mypreorder.php">my pre-order</a>
      <li>
        <a href="orderhistory.php">order history</a>
      </li>
    </ul>
  </div>
  <!--  NAVIGATION END  -->

  <main>
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
$student_id = 1; //assume 1st;
date_default_timezone_set("Asia/Kuala_Lumpur");
$today = date("Y/m/d");

$sql = "SELECT Count(Food_ID), Order_No FROM foodorder WHERE Student_ID = $student_id and Order_Date='$today' and Order_Status='Order' GROUP BY Order_No ORDER BY Order_No DESC";
$result = $connectionString->query($sql);
while ($row = $result->fetch_array()) {
    $n = $row['Count(Food_ID)'];
    $order_no = $row['Order_No'];

    $sql2 = "SELECT restaurant.Restaurant_Name FROM (foodorder INNER JOIN food ON food.Food_ID = foodorder.Food_ID) INNER JOIN restaurant ON restaurant.Restaurant_ID = food.restaurant_ID WHERE Order_No = '$order_no' ORDER BY Order_ID";
    $result2 = $connectionString->query($sql2);
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
    // $connectionString->close();
    ?>

    <p style="text-align: center; color: rgb(119, 119, 119);">You've seen all your orders.</p>

  </main>
  <footer>
    <div class="copyright">
      <p>&copy 2020 - Try Guess</p>
    </div>
    <div class="social">
      <a href="#" class="support">Contact Us</a>
      <a href="#" class="face">f</a>
      <a href="#" class="tweet">t</a>
      <a href="#" class="linked">ig</a>
    </div>
  </footer>

  <script type="text/javascript" src="js/menu.js"></script>
  <script type="text/javascript" src="js/index.js"></script>


</body>

</html>

<?php
include_once("searchFilterFood.php");
?>
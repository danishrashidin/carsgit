<!DOCTYPE html>
<html>

<head id="food-head">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Food - Order History</title>
  <link rel="stylesheet" type="text/css" href="css/food.css">
  <link rel="stylesheet" type="text/css" href="css/menu.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
  <link rel="stylesheet" href="css/login.css" />
  <!-- for search icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>



<body id="food-body">
  <!-- Navigation bar -->
  <nav class="navbar-expand-lg transitive" id="navbar">
    <!-- Nav Container -->
    <div class="nav-container transitive" id="nav-container">
      <!-- Home brand -->
      <a class="" href="index.html" style="float: left; padding: 0;">
        <img src="" height="30px" alt="" />
        College Activity Registration System
      </a>

      <!-- Menus -->
      <div class="menu" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item active px-4">
            <a class="nav-link" href="index.html">HOME <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item px-4">
            <a class="nav-link" href="activity.html">ACTIVITIES</a>
          </li>
          <li class="nav-item px-4">
            <a class="nav-link" href="food.php">FOOD</a>
          </li>
          <li class="nav-item px-4">
            <a class="nav-link" href="application.html">ACCOMMODATION</a>
          </li>
          <li class="nav-item px-4" style="margin-right: 64px;">
            <a class="nav-link" href="report.html">REPORT</a>
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

      <h1> Order History </h1>
      <!-- use form to go to another page -->
      <form action="/action_page.php">
        <div class="search-container">
          <input type="text" placeholder="Search food, restaurants..." name="search">
          <button type="submit"><i class="fa fa-search"></i></button>
        </div>
      </form>

    </div>
  </header>

  <!--  NAVIGATION  -->
  <div class="main-nav">
    <ul>
      <li>
        <a href="myorder.php">my order</a>
      </li>
      <li>
        <a href="mypreorder.php">my pre-order</a>
      <li>
        <a href="orderhistory.php" class="active">order history</a>
      </li>
    </ul>
  </div>
  <!--  NAVIGATION END  -->

  <main>

    <?php
    include_once("config.php");
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

  <script type="text/javascript" src="js/food.js"></script>
</body>

</html>
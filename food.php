<!DOCTYPE html>
<html>

<head id="food-head">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Food</title>
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

      <h1> online food order </h1>
      <h2> lazy to queue up for food everyday? <br> </h2>
      <h3> now you can order food online!</h3>
      <!-- use form to go to another page -->
      <form method="GET" action="food.php">
        <div class="search-container">
          <input type="text" placeholder="Search food..." name="search">
          <button type="submit"><i class="fa fa-search"></i></button>
        </div>
      </form>

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
        <a href="myorder.php">my order</a>
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
      <?php
      include_once('config.php');
      $student_id = 1;
      $sql = "SELECT college.College_ID, college.College_Name FROM student INNER JOIN college ON student.College_ID = college.College_ID WHERE Student_ID=$student_id";
      $result = $connectionString->query($sql);
      while ($row = $result->fetch_array()) {
        $col_id = $row['College_ID'];
        $res_location = $row['College_Name'];
      }
      ?>
      <h2><?php echo $res_location; ?></h2>
    </div>

    <!-- create a group to store restaurant cards -->
    <div class="card-group">
      <?php
      $sql2 = "SELECT restaurant.Restaurant_ID, restaurant.Restaurant_Name, restaurant.Restaurant_Type, restaurant.Restaurant_hours FROM restaurant WHERE College_ID=$col_id ORDER BY restaurant.Restaurant_Name";
      $result2 = $connectionString->query($sql2);
      while ($res = $result2->fetch_array()) {
        $res_id = $res['Restaurant_ID'];
        $res_name = $res['Restaurant_Name'];
        $res_type = $res['Restaurant_Type'];
        $res_hours = $res['Restaurant_hours'];

        /*attention: all restaurant img should be in .JPG format. */
        echo '  <div class="restaurant-card">
                        <img id="res-img" src="assets/restaurant/' . $res_name . '.jpg" alt="' . $res_name . '">
                        <div class="card-container">
                            <h4><b id="name" >' . $res_name . '</b></h4>
                            <ul style="list-style-type: none;">
                                <li id="location"><b>Type: ' . $res_type . '</b></li>
                                <li id="available-hours"><b>Available hours: ' . $res_hours . '</b></li>
                            </ul>
                        </div>
                        <div class="overlay">
                            <a id="menu" href="menu.php?Restaurant_ID=' . $res_id . '"><button class="view_menu" title="Click to view menu">View Menu</button></a>
                        </div>
                    </div>';
      }
      // $connectionString->close();
      ?>
    </div>
    <!-- card-group end -->

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
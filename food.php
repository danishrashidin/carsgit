<link rel="stylesheet" type="text/css" href="css/food.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<!-- for search icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="food-body">
  <div class="description">
    <div class="main-container">

      <h1> online food order </h1>
      <h2> lazy to queue up for food everyday? <br> </h2>
      <h3> now you can order food online!</h3>
      <!-- use form to go to another page -->
      <form method="GET" action="dashboard.php">
        <div class="search-container">
          <input type="hidden" name="page" value="food">
          <input type="text" placeholder="Search food..." name="search">
          <button type="submit"><i class="fa fa-search"></i></button>
        </div>
      </form>
    </div>
  </div>

  <div class="overlayMessage" id="overlayFoundMessage" onclick="offFoundMessage()" title="Click anywhere to close this window">
    <div id="Message" style="color: 200; ">Found!
      <table id="foundMessage">
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
        <a href="dashboard.php?page=orderhistory">order history</a>
      </li>
    </ul>
  </div>
  <!--  NAVIGATION END  -->

  <div>
    <div class="horizontal-bar-row">
      <?php
      include_once('config.php');
      if (isset($_SESSION['Student_ID'])) {
        $student_id = $_SESSION['Student_ID'];
      }
      $sql = "SELECT college.College_ID, college.College_Name FROM student INNER JOIN college ON student.College_ID = college.College_ID WHERE Student_ID=$student_id";
      $result = $connection->query($sql);
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
      $result2 = $connection->query($sql2);
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
                            <a id="menu" href="dashboard.php?page=menu&Restaurant_ID=' . $res_id . '"><button class="view_menu" title="Click to view menu">View Menu</button></a>
                        </div>
                    </div>';
      }
      // $connection->close();
      ?>
    </div>
    <!-- card-group end -->
    <script type="text/javascript" src="js/menu.js"></script>

    <?php
    include_once("searchFilterFood.php");
    ?>
  </div>
</div>
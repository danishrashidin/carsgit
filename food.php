<!DOCTYPE html>
<html>

<head id="food-head">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Food</title>
  <link rel="stylesheet" type="text/css" href="css/food.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
  <link rel="stylesheet" href="css/login.css" />

  <!-- for search icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body id="food-body">


  <header class="description">
    <div class="main-container">

      <h1> online food order </h1>
      <h2> lazy to queue up for food everyday? <br> </h2>
      <h3> now you can order food online!</h3>
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
        <a href="orderhistory.php">order history</a>
      </li>
    </ul>
  </div>
  <!--  NAVIGATION END  -->

  <main>
    <div class="horizontal-bar-row">
      <?php
include_once 'config.php';
$student_id = 1;
$sql = "SELECT college.College_ID, college.College_Name FROM student INNER JOIN college ON student.College_ID = college.College_ID WHERE Student_ID=$student_id";
$result = $connectionString->query($sql);
while ($row = $result->fetch_array()) {
    $col_id = $row['College_ID'];
    $res_location = $row['College_Name'];
}
?>
      <h2><?php echo $res_location; ?></h2>
      <!-- <div class="select-container">
        <label for="college-select">
          <h6>View other college</h6>
        </label>
        <select id="college-select" onchange="location = this.value" title="Choose to view other college menu">
          <option value="/kk1-food">Residential College 1</option>
          <option value="/kk2-food">Residential College 2</option>
          <option value="/kk3-food">Residential College 3</option>
          <option value="/kk4-food">Residential College 4</option>
          <option value="/kk5-food">Residential College 5</option>
          <option value="/kk6-food">Residential College 6</option>
          <option value="/kk7-food">Residential College 7</option>
          <option value="food.html">Residential College 8</option>
          <option value="/kk9-food">Residential College 9</option>
          <option value="/kk10-food">Residential College 10</option>
          <option value="/kk11-food">Residential College 11</option>
          <option value="/kk12-food">Residential College 12</option>
        </select>
      </div> -->
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
$connectionString->close();
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

  <script type="text/javascript" src="js/food.js"></script>

</body>

</html>
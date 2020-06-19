<?php

$pagename = "";
if (isset($_GET['page'])) {
    $name = $_GET['page'];
    switch ($name) {
        case 'dashboard':
            $pagename = "Dashboard";
            break;
        case 'activities':
            $pagename = "Activities";
            break;
        case 'food':
            $pagename = "Food";
            break;
        case 'acommodation':
            $pagename = "Acommodation";
            break;
        case 'report':
            $pagename = "Report";
            break;
        case 'profile':
            $pagename = "Your Profile";
            break;
        default:
            $pagename = "Dashboard";
    }
}

// Get session variable
if (isset($_SESSION["email"])) {
    $identifier = $_SESSION["userEmail"];
} else {
    //die("Please login");
}

// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$connect = new mysqli($servername, $username, $password, $dbname);

if ($connect->connect_error) {die("Failed");}
$student_data = 'SELECT * FROM
student WHERE Email="wif180040@siswa.um.edu.my"';
$result =
$connect->query($student_data);?>

<!DOCTYPE html>
<html>
  <head>
    <title>
      Dashboard
    </title>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" /> -->

    <!-- Fonting -->
    <link
      href="https://fonts.googleapis.com/css2?family=Manrope:wght@800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/dashboard.css" />

    <script type="text/javascript" src="js/dashboard.js" defer></script>
    <script defer>
      feather.replace();
    </script>
    <script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"
      defer
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
      defer
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"
      defer
    ></script>
    <script type="text/javascript">
      <?php
echo 'window.addEventListener("DOMContentLoaded", function() {
        (function($) {
          document.getElementById("' . $name . '-button").classList.add("active");
          feather.replace();
        })(jQuery)
      })';
?>
  </script>
  </head>

  <body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg transitive" id="navbar">
      <!-- Home brand -->
      <a
        class="navbar-brand"
        href="index.html"
        style="float: left; padding: 0;"
      >
        CARS
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menus -->
      <div class="menu collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <!-- Log out button -->
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              data-toggle="dropdown"
              href="#"
              role="button"
              aria-haspopup="true"
              aria-expanded="false"
              >Danish Rashidin</a
            >
            <div class="dropdown-menu">
              <a class="dropdown-item" href="dashboard.php?page=profile"
                >Edit Profile</a
              >
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Log Out</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <main>
      <div class="row dashboard-container">
        <div class="col-2 sidebar pt-4">
          <ul class="nav nav-pills flex-column" role="tablist">
            <li class="nav-item">
              <a
                id="dashboard-button"
                class="nav-link"
                href="dashboard.php?page=dashboard"
              >
                <span data-feather="box"></span>Dashboard</a
              >
            </li>
            <li class="nav-item">
              <a
                id="activities-button"
                class="nav-link"
                href="dashboard.php?page=activities"
              >
                <span data-feather="activity"></span>Activities</a
              >
            </li>
            <li class="nav-item">
              <a
                id="food-button"
                class="nav-link"
                href="dashboard.php?page=food"
              >
                <span data-feather="coffee"></span>Food</a
              >
            </li>
            <li class="nav-item">
              <a
                id="acommodation-button"
                class="nav-link"
                href="dashboard.php?page=acommodation"
              >
                <span data-feather="home"></span>Accommodation</a
              >
            </li>
            <li class="nav-item">
              <a
                id="report-button"
                class="nav-link"
                href="dashboard.php?page=report"
              >
                <span data-feather="file-text"></span>Report</a
              >
            </li>
          </ul>
        </div>
        <div class="col-10 scrollable ml-auto">
          <div class="fragment-container">
            <div class="fragment-title-container">
              <h2 class="fragment-title"><?php echo $pagename ?></h2>
            </div>
            <div class="fragment">
            <?php
if (isset($_GET['page'])) {
    $display = $name . '.php';
    if ($name == "dashboard") {
    } else if (file_exists($display)) {
        include_once $display;
    } else {
        echo $display . " does not exist";
    }
} else {
    echo "No page binded";
}
?>
            </div>
          </div>
        </div>
      </div>
    </main>


  </body>
</html>

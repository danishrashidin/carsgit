<!DOCTYPE html>
<html>
  <head>
    <title>
      Profile Dashboard - CARS UMs
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
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/tippy.js@6/animations/scale.css"
    />
    <link rel="stylesheet" type="text/css" href="css/dashboard.css"/>

    <!-- Fonting -->
    <link
      href="https://fonts.googleapis.com/css2?family=Manrope:wght@800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
  </head>
  <body>

    <main>
      <div class="dashboard-container">
        <div class="left">
          <div class="profile-links-card">
            <div class="profile">
              <img class="profile-img" alt="" src="assets/profile-img.jpg">
              <h6 class="profile-name">Muhammad Danish bin Mohammad Rashidin</h6>
              <p class="profile-email">danishrashidin@gmail.com</p>
              <a class="view-profile" href="dashboard.php?page=profile">View Profile</a>
            </div>
            <div class="separator"></div>
            <div class="links">
              <p class="link-header">Accommodation</p>
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" href="dashboard.php?page=accommodation_apply">Apply</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="dashboard.php?page=accommodation_all">See All Applications</a>
                </li>
              </ul>
              <p class="link-header">Complaints</p>
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" href="dashboard.php?page=report_apply">File a new report</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="dashboard.php?page=report_all">See All Reports</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="middle">
          <div class="fragment-container">
            <div class="fragment-title-container">
              <h2 class="fragment-title">Profile Details</h2>
            </div>
            <div class="embed-container">
              <?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $display = $page . '.php';
    if (file_exists($display)) {
        include $display;
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

  <script type="text/javascript" src="js/dashboard.js"></script>
</html>

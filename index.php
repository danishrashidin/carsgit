<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
}
if (isset($_POST['action'])) {
    if ($action == 'login-success') {
        $_SESSION['userEmail'] = $_GET['email'];
    }}
?>



<!DOCTYPE html>
<html>
    <head>
    <title>CARS UM</title>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
    <link rel="stylesheet" href="css/login.css" />

    <!-- Fonting -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet" />
    </head>

    <body style="margin: 0;">
    <div class="nav-content-wrapper">

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
                <a class="nav-link" href="food.html">FOOD</a>
                </li>
                <li class="nav-item px-4">
                <a class="nav-link" href="application.html">ACCOMMODATION</a>
                </li>
                <li class="nav-item px-4" style="margin-right: 64px;">
                <a class="nav-link" href="report.html">REPORT</a>
                </li>

                <!-- two buttons -->
                <li class="nav-item">
                <button
                    type="button"
                    class="btn nav-btn px-4 py-2"
                    style="background-color: #00df89; border-color: #00df89;"
                >
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


        <!-- Header -->
        <header id="header" style="overflow: hidden; display: flex; flex-direction: row;">
        <div class="jumbotron m-0" style="background-color: rgba(0, 0, 0, 0);">
            <h1 class="header-title">A new, redefined system</h1>
            <p class="lead" style="max-width: 55vw;">
            We call it <b>CARS</b>. Well, its longer name, College Activity Registration System. Designed with love by
            students, for students.
            </p>
            <hr class="my-4" />
            <div class="header-button-container">
            <button
                type="button"
                class="btn header-btn px-5 py-3"
                style="background-color: #00df89; border-color: #00df89;"
            >
                CONTACT US
            </button>
            <button id="button-sign-up" type="button" class="btn btn-outline-light header-btn px-5 py-3">
                SIGN UP
            </button>
            </div>
        </div>

        <img class="header-image" src="assets/cert.svg" />
        </header>
    </div>

    <main>
        <h1 class="title-center">Upcoming Actvities</h1>

        <!-- Activities wrapper -->
        <div class="carousel-wrapper">
        <!-- Bootstrap Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="assets/image-1.jpg" alt="First slide" />
                <div class="carousel-caption d-none d-md-block">
                <h5>Activity 1</h5>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.
                </p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="assets/image-2.jpg" alt="Second slide" />
                <div class="carousel-caption d-none d-md-block">
                <h5>Activity 2</h5>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.
                </p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="assets/image-3.jpg" alt="Third slide" />
                <div class="carousel-caption d-none d-md-block">
                <h5>Activity 3</h5>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.
                </p>
                </div>
            </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- Desc -->
        <div class="description-wrapper">
            <div class="headline">
            <div style="height: 2px; width: 24px; background-color: #00df89; margin-right: 12px;"></div>
            <p>ALL IN ONE</p>
            </div>
            <div class="description">
            <h1 style="width: 80%;">
                All college activities in one place
            </h1>
            <p style="width: 75%;">
                Imagine, being a University of Malaya student wanting to join communtities from different colleges, but
                clueless on how to get on track? It's okay. We do it for you.<br />
            </p>

            <p style="width: 75%;">
                From here, you can do so many things, from viewing available activities, to joining multiple communities
                in a single click<br />
            </p>
            <a
                type="button"
                class="btn desc-btn px-5 py-3"
                style="background-color: #00df89; border-color: #00df89;"
                href="activity.html"
            >
                FIND OUT MORE
            </a>
            </div>
        </div>
        </div>

        <div class="features"></div>
    </main>


<?php if (isset($action)) {
    if ($action == 'verifying' || $action == 'reset password') {
        include_once 'db.php';

        $email = $_POST['email'];
        $Activation_Hash = $_POST['Activation_Hash'];

        $sql = "SELECT * FROM student WHERE Email = '$email' AND Activation_Hash = '$Activation_Hash'";
        $results = $connection->query($sql);
        $data = $results->fetch();

        if ($data && $action == 'reset password') {
            echo '<input type="hidden" class="--reset_Password" name="userEmail" value="' . $email . '" >';

        } else if ($data && $action == 'verifying') {
            $sql = "UPDATE student SET Verified = '1' WHERE Email = '$email' AND Activation_Hash = '$Activation_Hash'";
            $connection->query($sql);
            echo '<input type="hidden" class="--verificationSuccessfull">';
        }
    }
}?>

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

    <script type="text/javascript" src="js/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://kit.fontawesome.com/e881600de5.js" crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"
    ></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.0.11/purify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script type="module" src="js/logincontroller.js"></script>
    </body>
</html>

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
    }
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $phpfile = $page . '.php';
} else {
    $phpfile = 'home.php';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>CARS UM</title>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" href="css/login.css" />

    <!-- Fonting -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet" />
</head>

<body style="margin: 0;">
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg transitive" id="navbar">
        <!-- Home brand -->
        <a class="navbar-brand" href="#" style="float: left; padding: 0;">
            College Activity Registration System
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menus -->
        <div class="menu collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=activity" class="nav-link">ACTIVITIES</a>
                </li>
                <button id="button-log-in" type="button" class="btn btn-outline-light px-4 py-2">
                    LOGIN
                </button>
            </ul>
        </div>
    </nav>

    <?php

if (file_exists($phpfile)) {
    include $phpfile;
} else {
    echo 'Error: No page binded';
}

if (isset($action)) {
    if ($action == 'verifying' || $action == 'reset password') {
        include_once 'pdo.php';

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
}
include "components/footer.php";

?>

    <script type="text/javascript" src="js/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://kit.fontawesome.com/e881600de5.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.0.11/purify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script type="module" src="js/logincontroller.js"></script>
</body>

</html>
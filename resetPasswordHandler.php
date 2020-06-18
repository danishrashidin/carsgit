<?php

include_once 'db.php';

function sanitizingData($data)
{ // Removes all PHP and HTML tags via strip_tags()
    //Converts all special characters to their HTML-entity equivalents via tmlspecialchars()
    return htmlspecialchars(strip_tags($data));
};

if (($_POST['action']) == "send reset password") {
    $email = sanitizingData($_POST['forgot-email']);

    $sql = "SELECT * FROM student WHERE Email = '$email'";
    $emailCheck = $connection->query($sql);

    //store fetch data into array
    $data = $emailCheck->fetch();

}

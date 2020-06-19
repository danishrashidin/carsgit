<?php

include_once 'pdo.php';

$response = array("status" => "", "emailError" => "", "generalError" => "", "verified" => 0);

function sanitizingData($data)
{ // Removes all PHP and HTML tags via strip_tags()
    //Converts all special characters to their HTML-entity equivalents via tmlspecialchars()
    return htmlspecialchars(strip_tags($data));
};

$email = sanitizingData($_POST['email']);
$password = sanitizingData($_POST['password']);

$sql = "SELECT * FROM student WHERE Email = '$email'";
$emailCheck = $connection->query($sql);

//store fetch data into array
$data = $emailCheck->fetch();

// print_r($data);

if (!$data) {
    $response['status'] = 'failed';
    $response['emailError'] = 'The email address that you\'ve  entered  <span style="color:yellow">doesn\'t match any account.</span> Please try again and do a double check.';
    print_r(json_encode($response));

} else {
    if (!password_verify($password, $data['Password_'])) {
        $response['status'] = 'failed';
        $response['generalError'] = 'Incorrect <span style="color:yellow">SiswaMail</span> and/or <span style="color:yellow">password.</span> Please do a double check and try again.';

        print_r(json_encode($response));
    } else {
        $response['status'] = 'success';
        $response['verified'] = $data['Verified'];
        print_r(json_encode($response));

    }

}

<?php

$databaseHost = 'localhost';
$databaseName = 'cars';
$databaseUsername = 'user1';
$databasePassword = '12345';



$mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}





?>

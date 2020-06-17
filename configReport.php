<?php
$databaseHost = "localhost";
$databaseName = "web programming";
$databaseUsername = "izzati";
$databasePassword  = "marshmallow1";

$mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}
?>

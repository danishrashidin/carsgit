<?php

$host = "localhost";
$dbname = "tryguess_food";
$dbusername = "user";
$dbuserpassword = "userpwd";

$connectionString = new mysqli($host,$dbusername,$dbuserpassword,$dbname);
// echo "Database connected successfully";

if($connectionString->connect_error){
    die("Connection failed: ".$connectionString->connect_error);
}
?>
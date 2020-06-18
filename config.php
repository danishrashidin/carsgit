<?php

$host = "localhost";
$dbname = "tryguess_food";
$dbusername = "amyng56";
$dbuserpassword = "19990506";

$connectionString = new mysqli($host,$dbusername,$dbuserpassword,$dbname);
// echo "Database connected successfully";

if($connectionString->connect_error){
    die("Connection failed: ".$connectionString->connect_error);
}
?>
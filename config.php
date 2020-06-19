<?php

$host = "localhost";
$dbname = "cars";
$dbusername = "root";
$dbuserpassword = "";

$connectionString = new mysqli($host,$dbusername,$dbuserpassword,$dbname);
// echo "Database connected successfully";

if($connectionString->connect_error){
    die("Connection failed: ".$connectionString->connect_error);
}
?>
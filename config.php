<?php

$host = "localhost";
$dbname = "cars";
$dbusername = "root";
$dbuserpassword = "";

$connection = new mysqli($host,$dbusername,$dbuserpassword,$dbname);
// echo "Database connected successfully";

if($connection->connect_error){
    die("Connection failed: ".$connectionString->connect_error);
}
?>
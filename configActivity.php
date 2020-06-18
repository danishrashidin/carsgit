<?php
$host = "localhost";
$dbname = "tryguess_activity";
$username = "user";
$password = "user123";

$connectionString = new mysqli($host,$username,$password,$dbname);

if($connectionString->connect_error){
    die("Connection failed: ".$connectionString->connect_error);
}

?>
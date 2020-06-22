<?php
$host = "localhost";
$dbname = "cars";
$username = "root";
$password = "";

$connectionString = new mysqli($host, $username, $password, $dbname);

if ($connectionString->connect_error) {
    die("Connection failed: " . $connectionString->connect_error);
}

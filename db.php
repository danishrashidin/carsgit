<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cars";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

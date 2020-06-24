<?php

include "config.php";

$id = $_GET['id'];
$sql = "";
$result = $connection->query($sql);

header("Location:dashboard.php?page=accommodation");

// include "accommodation.php";

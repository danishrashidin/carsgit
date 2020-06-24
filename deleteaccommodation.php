<?php

include "config.php";

$id = $_GET['id'];
$sql = "DELETE FROM accomodation WHERE Application_ID=$id";
$connection->query($sql);

// header("Location:dashboard.php?page=accommodation");

include 'accommodation.php';

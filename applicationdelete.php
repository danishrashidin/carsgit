<?php

include("config.php");

$id = $_GET['id'];

$result = mysqli_query($connection, "DELETE FROM accomodation WHERE Application_ID=$id");

header("applicationindex.php");

?>


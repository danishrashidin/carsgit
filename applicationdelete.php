<?php

include("applicationconfig.php");

$id = $_GET['id'];

$result = mysqli_query($mysqli, "DELETE FROM accomodation WHERE Application_ID=$id");

header("applicationindex.php");

?>


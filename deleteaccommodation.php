<?php

include "config.php";

$id = $_GET['id'];
$sql = "";
$result = $connection->query($sql);

$result = mysqli_query($connection, "DELETE FROM accomodation WHERE Application_ID=$id");

include "accommodation.php";

?>

// include "accommodation.php";

<?php

include("config.php");

$id = $_GET['id'];

$result = mysqli_query($connection, "DELETE FROM report WHERE ReportID=$id");

header("Location:reportIndex.php");

?>
<?php

include("configReport.php");

$id = $_GET['id'];

$result = mysqli_query($mysqli, "DELETE FROM report WHERE ReportID=$id");

header("Location:reportIndex.php");

?>
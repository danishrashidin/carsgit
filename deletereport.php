<?php

include("config.php");

$id = $_GET['id'];

$result = mysqli_query($connection, "DELETE FROM report WHERE Report_ID=$id");

include('report.php');

?>
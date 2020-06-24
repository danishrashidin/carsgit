<?php

include "config.php";

$id = $_GET['id'];
$sql = "DELETE FROM accomodation WHERE Application_ID=$id";
$connection->query($sql);

// header("Location:dashboard.php?page=accommodation");

echo '<script type="text/javascript">window.location.href="dashboard.php?page=accommodation"</script>';

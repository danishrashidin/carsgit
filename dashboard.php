<?php
session_start();
if (isset($_GET['method'])) {
    echo $_GET['method'] . '<br>';

    echo 'from url: ' . $_GET['email'] . '<br>';
}

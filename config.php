<?php

session_start();

$_SESSION["dbhost"] = "localhost";
$_SESSION["dbuser"] = "root";
$_SESSION["dbpass"] = "";
$_SESSION["dbname"] = "anketa";

header('Location: ./stranice/registration.php');
die();
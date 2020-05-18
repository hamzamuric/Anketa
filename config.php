<?php

session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "anketa";

$_SESSION["dbhost"] = "localhost";
$_SESSION["dbuser"] = "root";
$_SESSION["dbpass"] = "";
$_SESSION["dbname"] = "anketa";

//header('Location: ./stranice/registration.php');
header('Location: ./stranice/registration.php');
die();
<?php

session_start();

if (!$_SESSION["dbhost"]) {
    $_SESSION["redirect"] = './akcije/valid.php';
    header('Location: ../config.php');
    die();
}

$dbhost = $_SESSION["dbhost"];
$dbuser = $_SESSION["dbuser"];
$dbpass = $_SESSION["dbpass"];
$dbname = $_SESSION["dbname"];

$email = $_GET["email"];
$valid = $_GET["valid"];

if (!isset($_SESSION['admin'])) {
    header('Location: admin-login.php');
    die();
}

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$sql = "UPDATE `korisnik` SET `valid` = '$valid' WHERE `korisnik`.`email` = '$email';";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql);

header("Location: ../stranice/details.php?email=$email");
die();

?>
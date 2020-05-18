<?php

session_start();

if (!$_SESSION["dbhost"]) {
    $_SESSION["redirect"] = './akcije/valid.php';
    header('Location: ../config.php');
    die();
}
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "anketa";

$email = $_GET["email"];
$valid = $_GET["valid"];
$valid = $valid ? 1 : 0;

if (!isset($_SESSION['admin'])) {
    header('Location: admin-login.php');
    die();
}

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$sql = "UPDATE `korisnik` SET `valid`=$valid WHERE `email`='$email';";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql);

header("Location: ../stranice/details.php?email=$email");
die();

?>
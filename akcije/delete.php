<?php

session_start();

if (!$_SESSION["dbhost"]) {
    $_SESSION["redirect"] = './akcije/delete.php';
    header('Location: ../config.php');
    die();
}

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "anketa";

$email = $_GET["email"];

if (!isset($_SESSION['admin'])) {
    header('Location: admin-login.php');
    die();
}

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$sql = "DELETE FROM korisnik WHERE `email`='$email';";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql);

header('Location: ../stranice/admin.php');
die();

?>
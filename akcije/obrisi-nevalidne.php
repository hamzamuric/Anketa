<?php

session_start();

if (!$_SESSION["dbhost"]) {
    $_SESSION["redirect"] = './stranice/obrisi-nevalidne.php';
    header('Location: ../config.php');
    die();
}

$dbhost = $_SESSION["dbhost"];
$dbuser = $_SESSION["dbuser"];
$dbpass = $_SESSION["dbpass"];
$dbname = $_SESSION["dbname"];

if (!isset($_SESSION['admin'])) {
    header('Location: admin-login.php');
    die();
}

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$sql = "DELETE FROM korisnik WHERE `valid` <> 1 or `valid` is NULL;";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql);

header('Location: ../stranice/admin.php');
die();

?>
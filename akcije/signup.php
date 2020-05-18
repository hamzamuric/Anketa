<?php

session_start();

if (!$_SESSION["dbhost"]) {
    $_SESSION["redirect"] = './akcije/signup.php';
    header('Location: ../config.php');
    die();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../stranice/registration.php');
    die();
}

$email = $_POST['email'];
$password = $_POST['password'];
$password_again = $_POST['password-again'];

if (!(isset($email) && isset($password) && isset($password_again)) || empty($email) || empty($password) || empty($password_again)) {;
    header('Location: ../stranice/err-email-prazan.html');
    die();
}

if ($password != $password_again) {
    header('Location: ../stranice/err-razlicite-lozinke.html');
    die();
}

$ok = make_user($email, $password);
if ($ok) {
    $_SESSION['logged'] = $email;
    header('Location: ../stranice/anketa.php');
    die();
} else {
    header('Location: ../stranice/err-vec-postoji.html');
    die();
}

function make_user($mail, $pass) {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "anketa";
    $password_hash = password_hash($pass, PASSWORD_DEFAULT);
    $query = "INSERT INTO `korisnik` (`email`, `password`) VALUES ('$mail', '$password_hash');";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {
        echo 'connection error<br>';
        return false;
    }

    $ok = $conn->query($query);
    $conn->close();
    return $ok;
}
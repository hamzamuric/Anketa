<?php

session_start();

if (!$_SESSION["dbhost"]) {
    $_SESSION["redirect"] = './akcije/login.php';
    header('Location: ../config.php');
    die();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../stranice/registration.php');
    die();
}

$email = $_POST['email'];
$password = $_POST['password'];

if (!(isset($email) && isset($password)) || empty($email) || empty($password)) {
    header('Location: ../stranice/err-email-prazan.html');
    die();
}

if (check_login($email, $password)) {
    $_SESSION['logged'] = $email;
    header('Location: ../stranice/anketa.php');
    die();
} else {
    header('Location: ../stranice/err-podaci-neispravni.html');
    die();
}

function check_login($mail, $pass) {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "anketa";
    $query = "SELECT `password` FROM `korisnik` WHERE `email`='$mail';";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {
        echo 'connection error';
        return false;
    }

    $result = $conn->query($query);
    if ($result->num_rows == 0) {
        return false;
    }

    $db_password = $result->fetch_assoc()['password'];
    $ok = password_verify($pass, $db_password);

    $conn->close();
    return $ok;
}
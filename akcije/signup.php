<?php

session_start();

if (!$_SESSION["dbhost"]) {
    $_SESSION["redirect"] = './akcije/signup.php';
    header('Location: ../config.php');
    die();
}

$dbhost = $_SESSION["dbhost"];
$dbuser = $_SESSION["dbuser"];
$dbpass = $_SESSION["dbpass"];
$dbname = $_SESSION["dbname"];

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../stranice/registration.php');
    die();
}

$email = $_POST['email'];
$password = $_POST['password'];
$password_again = $_POST['password-again'];

if (!(isset($email) && isset($password) && isset($password_again)) || empty($email) || empty($password) || empty($password_again)) {
    echo '<h1>Polja ne smeju biti prazna!</h1><br/>';
    echo '<a href="../stranice/registration.php">Pokusajte ponovo</a>';
    die();
}

if ($password != $password_again) {
    echo '<h1>Lozinke se ne poklapaju!</h1><br/>';
    echo '<a href="../stranice/registration.php">Pokusajte ponovo</a>';
    die();
}

$ok = make_user($email, $password);
if ($ok) {
    $_SESSION['logged'] = $email;
    header('Location: ../stranice/anketa.php');
    die();
} else {
    echo '<h1>Vec postoji korisnik sa emailom: ' . $email . '</h1><br/>';
    echo '<a href="../stranice/registration.php">Pokusajte ponovo</a>';
    die();
}

function make_user($mail, $pass) {
    $password_hash = password_hash($pass, PASSWORD_DEFAULT);
    $query = "INSERT INTO `korisnik` (`email`, `password`) VALUES ('$mail', '$password_hash');";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {
        echo 'connection error';
        return false;
    }

    $ok = $conn->query($query);
    $conn->close();
    return $ok;
}
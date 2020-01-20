<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../index.html');
    die();
}

$email = $_POST['email'];
$password = $_POST['password'];
$password_again = $_POST['password-again'];

if (!(isset($email) && isset($password) && isset($password_again)) || empty($email) || empty($password) || empty($password_again)) {
    echo '<h1>Polja ne smeju biti prazni!</h1><br/>';
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

function make_user($main, $pass) {
    return true;
}
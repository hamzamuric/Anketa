<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../index.html');
    die();
}

$email = $_POST['email'];
$password = $_POST['password'];

if (!(isset($email) && isset($password)) || empty($email) || empty($password)) {
    echo '<h1>E-mail i lozinka ne smeju biti prazni!</h1><br/>';
    echo '<a href="../stranice/registration.php">Pokusajte ponovo</a>';
    die();
}

if (check_login($email, $password)) {
    $_SESSION['logged'] = $email;
    header('Location: ../stranice/anketa.php');
    die();
} else {
    echo '<h1>E-mail i lozinka nisu ispravni.</h1><br/>';
    echo '<a href="../stranice/registration.php">Pokusajte ponovo</a>';
    die();
}

function check_login($mail, $pass) {
    if ($mail == 'hamza' && $pass == 'hamza')
        return true;
    return false;
}
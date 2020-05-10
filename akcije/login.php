<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../stranice/registration.php');
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
    $query = "SELECT `password` FROM `korisnik` WHERE `email`='$mail';";
    $conn = new mysqli('localhost', 'root', '', 'anketa');
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
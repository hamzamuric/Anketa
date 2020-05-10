<?php

session_start();

if (isset($_SESSION['logged'])) {
    unset($_SESSION['logged']);
}

if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
}

session_destroy();
header('Location: ../stranice/registration.php');
die();

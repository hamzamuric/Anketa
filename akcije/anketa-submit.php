<?php

session_start();

if (!$_SESSION["dbhost"]) {
    $_SESSION["redirect"] = './akcije/anketa-submit.php';
    header('Location: ../config.php');
    die();
}

$dbhost = $_SESSION["dbhost"];
$dbuser = $_SESSION["dbuser"];
$dbpass = $_SESSION["dbpass"];
$dbname = $_SESSION["dbname"];

$answers = array();
$score = 0;

for ($i = 0; $i < 7; $i++) {
    if (!isset($_POST['p' . $i])) {
        echo '<h1>Morate odgovoriti na sva pitanja.</h1>';
        echo '<a href="../stranice/anketa.php">Pokusajte ponovo</a>';
        die();
    }
    $answer = explode(',', $_POST['p' . $i]);
    $answers[$i] = $answer[0];
    $score += (int)$answer[1];
}


for ($i = 7; $i < 10; $i++) {
    if (!isset($_POST['p' . $i])) {
        echo '<h1>Morate odgovoriti na sva pitanja.</h1>';
        echo '<a href="../stranice/anketa.php">Pokusajte ponovo</a>';
        die();
    }
    $p = $_POST['p' . $i];
    $answer = array();
    foreach ($p as $ans) {
        $ans = explode(',', $ans);
        array_push($answer, $ans[0]);
        $score += (int)$ans[1];
    }
    $answers[$i] = implode(',', $answer);
}

$komentar = '';
if (isset($_POST['komentar'])) {
    $komentar = $_POST['komentar'];
}

$valid = abs($score) > 2;

$query = 
"UPDATE `korisnik`
SET `valid`=$valid, `p0`='$answers[0]', `p1`='$answers[1]', `p2`='$answers[2]', `p3`='$answers[3]', `p4`='$answers[4]', `p5`='$answers[5]', `p6`='$answers[6]', `p7`='$answers[7]',  `p8`='$answers[8]', `p9`='$answers[9]', `komentar`='$komentar' 
WHERE `email`='$_SESSION[logged]';";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    echo 'connection error';
    return false;
}

if($conn->query($query)) {
    echo '<h1>Hvala Vam sto ste popunili anketu.</h1>';
    echo '<a href="../stranice/registration.php">Pocetna strana</a>';
    die();
} else {
    echo '<h1>Doslo je do greske.</h1>';
    echo '<a href="../stranice/anketa.php">Pokusajte ponovo</a>';
    die();
}
$conn->close();

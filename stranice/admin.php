<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: admin-login.php');
    die();
}

$conn = new mysqli('localhost', 'root', '', 'anketa');
$sql = 'SELECT * FROM korisnik;';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bangers|Noto+Sans&display=swap">
    <link rel="stylesheet" href="../stilovi/style.css">
    <link rel="stylesheet" href="../stilovi/admin-style.css">
    <script defer src="../url-script.js"></script>
    <script defer src="admin-charts.js"></script>
    <title>Admin</title>
</head>
<body>
    <div class="head">
        <h1 class="head-title">Anketa</h1>
        <h3>Admin</h3>
        <img id="slika" src="../slike/decak-maska.png" alt="decak s maskom">
        <button id="logout" onclick="goto('/projekat/akcije/logout.php')">Odjavi se</button>
    </div>
    <div class="container">
        <p>Korisnici koji su popunili anketu (zeleni su validni, a crveni nisu):</p>
        <ul>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $color = $row['valid'] ? 'green' : 'red';
                        echo "<li style=\"color: $color;\"><a href=\"#\">$row[email]</a></li>";
                    }
                }
            ?>
        </ul>
    </div>
    <div class="container remove-invalid">
        <button onclick="goto('../akcije/obrisi-nevalidne.php')">Ukloni nevalidne ankete</button>
    </div>
    <div class="container">
        <p>Brinete li za svoje zdravlje? (Pitanje 1)</p>
        <canvas id="p0"></canvas>
    </div>
    <div class="container">
        <p>Mislite li da je vazduh u nasem gradu zagadjen? (Pitanje 2)</p>
    </div>
    <div class="container">
        <p>Mislite li da vam je zdravlje ugrozeno zbog zagadjenog vazduha? (Pitanje 3)</p>
    </div>
    <div class="container">
        <p>Koliko smatrate da je vazduh zagadjen? (Pitanje 4)</p>
    </div>
    <div class="container">
        <p>Koliko smatrate da je problem zagadjenog vazduga resiv? (Pitanje 5)</p>
    </div>
    <div class="container">
        <p>Jeste li imali kasalj u poslednje vreme? (Pitanje 6)</p>
    </div>
    <div class="container">
        <p>Mislite li da nasi gradjani treba da nose maske protiv zagadjenog vazduha? (Pitanje 7)</p>
    </div>
    <div class="container">
        <p>Sta smatrate glavnim razlozima za zagadjenost vazduha? (Pitanje 8)</p>
    </div>
    <div class="container">
        <p>Sta od navedenog smatrate da bi pomoglo kod problema zagadjenog vazduga? (Pitanje 9)</p>
    </div>
    <div class="container">
        <p>Koji gradovi su po vama najzagadjeniji? (Pitanje 10)</p>
    </div>
    <div class="container">
        <p>Komentari</p>
    </div>
    <div style="height: 200px;"></div>
</body>
</html>
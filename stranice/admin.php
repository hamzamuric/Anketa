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
    <script>
        let p0Data = [10, 10];
        let p1Data = [20, 10];
        let p2Data = [20, 10];
        let p3Data = [5, 3, 1, 4, 2];
        let p4Data = [1, 2, 3, 4, 5];
        let p5Data = [15, 3];
        let p6Data = [3, 5, 6, 2, 0];
        let p7Data = [20, 10, 5, 1];
        let p8Data = [1, 2, 3, 4];
        let p9Data = [4, 3, 2, 1];
        let komentari = ['neki komentar', 'neki drugi komentar', 'treci neki komentar'];
    </script>
    <script defer src="../url-script.js"></script>
    <script defer src="../Chart.bundle.min.js"></script>
    <script defer src="admin-charts.js"></script>
    <style>
        #komentari {
            list-style-type: disclosure-closed;
            margin-left: 20px;
        }
    </style>
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
        <canvas id="p1"></canvas>
    </div>
    <div class="container">
        <p>Mislite li da vam je zdravlje ugrozeno zbog zagadjenog vazduha? (Pitanje 3)</p>
        <canvas id="p2"></canvas>
    </div>
    <div class="container">
        <p>Koliko smatrate da je vazduh zagadjen? (Pitanje 4)</p>
        <canvas id="p3"></canvas>
    </div>
    <div class="container">
        <p>Koliko smatrate da je problem zagadjenog vazduga resiv? (Pitanje 5)</p>
        <canvas id="p4"></canvas>
    </div>
    <div class="container">
        <p>Jeste li imali kasalj u poslednje vreme? (Pitanje 6)</p>
        <canvas id="p5"></canvas>
    </div>
    <div class="container">
        <p>Mislite li da nasi gradjani treba da nose maske protiv zagadjenog vazduha? (Pitanje 7)</p>
        <canvas id="p6"></canvas>
    </div>
    <div class="container">
        <p>Sta smatrate glavnim razlozima za zagadjenost vazduha? (Pitanje 8)</p>
        <canvas id="p7"></canvas>
    </div>
    <div class="container">
        <p>Sta od navedenog smatrate da bi pomoglo kod problema zagadjenog vazduga? (Pitanje 9)</p>
        <canvas id="p8"></canvas>
    </div>
    <div class="container">
        <p>Koji gradovi su po vama najzagadjeniji? (Pitanje 10)</p>
        <canvas id="p9"></canvas>
    </div>
    <div class="container">
        <p>Komentari</p>
        <hr>
        <ul id="komentari">
        </ul>
    </div>
    <div style="height: 200px;"></div>
    <script>
        const komentariContainer = document.getElementById("komentari");
        komentari.forEach(k => {
            const li = document.createElement('li');
            li.innerHTML = k;
            komentariContainer.appendChild(li);
        });
    </script>
</body>
</html>
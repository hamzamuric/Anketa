<?php

session_start();

if (!$_SESSION["dbhost"]) {
    $_SESSION["redirect"] = './stranice/admin.php';
    header('Location: ../config.php');
    die();
}

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "anketa";

if (!isset($_SESSION['admin'])) {
    header('Location: admin-login.php');
    die();
}

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$sql = 'SELECT * FROM korisnik;';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql);

$users = array();
while ($r = $result->fetch_assoc()) {
    if ($r["valid"] == 1) {
        array_push($users, $r);
    }
}

$p0Data = array(0, 0);
$p1Data = array(0, 0);
$p2Data = array(0, 0);
$p3Data = array(0, 0, 0, 0, 0);
$p4Data = array(0, 0, 0, 0, 0);
$p5Data = array(0, 0);
$p6Data = array(0, 0, 0, 0, 0);
$p7Data = array(0, 0, 0, 0);
$p8Data = array(0, 0, 0, 0);
$p9Data = array(0, 0, 0, 0);

foreach ($users as $u) {
    if ($u["p0"] == "da")
        $p0Data[0]++;
    else if ($u["p0"] == "ne")
        $p0Data[1]++;

    if ($u["p1"] == "da")
        $p1Data[0]++;
    else if ($u["p1"] == "ne")
        $p1Data[1]++;

    if ($u["p2"] == "da")
        $p2Data[0]++;
    else if ($u["p2"] == "ne")
        $p2Data[1]++;

    $p3Data[$u["p3"] - 1]++;

    $p4Data[$u["p4"] - 1]++;
    
    if ($u["p5"] == "da")
        $p5Data[0]++;
    else if ($u["p5"] == "ne")
        $p5Data[1]++;

    switch ($u["p6"]) {
        case "nikako":   $p6Data[0]++; break;
        case "ne_bas":   $p6Data[1]++; break;
        case "mozda":    $p6Data[2]++; break;
        case "pozeljno": $p6Data[3]++; break;
        case "obavezno": $p6Data[4]++; break;
    }

    foreach (explode(',', $u["p7"]) as $p) {
        switch ($p) {
            case "fabrike":    $p7Data[0]++; break;
            case "ogrev":      $p7Data[1]++; break;
            case "automobili": $p7Data[2]++; break;
            case "tekstil":    $p7Data[3]++; break;
        }
    }

    foreach (explode(',', $u["p8"]) as $p) {
        switch ($p) {
            case "svest_gradjana":      $p8Data[0]++; break;
            case "nacin_grejanja":      $p8Data[1]++; break;
            case "ici_pesice":          $p8Data[2]++; break;
            case "ne_izlaziti_iz_kuce": $p8Data[3]++; break;
        }
    }

    foreach (explode(',', $u["p9"]) as $p) {
        switch ($p) {
            case "beograd":     $p9Data[0]++; break;
            case "novi_pazar":  $p9Data[1]++; break;
            case "bor":         $p9Data[2]++; break;
            case "sarajevo":    $p9Data[3]++; break;
        }
    }
}

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
        let p0Data = [<?php echo $p0Data[0] . ', ' . $p0Data[1] ?>];
        let p1Data = [<?php echo $p1Data[0] . ', ' . $p1Data[1] ?>];
        let p2Data = [<?php echo $p2Data[0] . ', ' . $p2Data[1] ?>];
        let p3Data = [<?php echo $p3Data[0] . ', ' . $p3Data[1] . ', ' . $p3Data[2] . ', ' . $p3Data[3] . ', ' . $p3Data[4] ?>];
        let p4Data = [<?php echo $p4Data[0] . ', ' . $p4Data[1] . ', ' . $p4Data[2] . ', ' . $p4Data[3] . ', ' . $p4Data[4] ?>];
        let p5Data = [<?php echo $p5Data[0] . ', ' . $p5Data[1] ?>];
        let p6Data = [<?php echo $p6Data[0] . ', ' . $p6Data[1] . ', ' . $p6Data[2] . ', ' . $p6Data[3] . ', ' . $p6Data[4] ?>];
        let p7Data = [<?php echo $p7Data[0] . ', ' . $p7Data[1] . ', ' . $p7Data[2] . ', ' . $p7Data[3] ?>];
        let p8Data = [<?php echo $p8Data[0] . ', ' . $p8Data[1] . ', ' . $p8Data[2] . ', ' . $p8Data[3] ?>];
        let p9Data = [<?php echo $p9Data[0] . ', ' . $p9Data[1] . ', ' . $p9Data[2] . ', ' . $p9Data[3] ?>];
        
        <?php
        $sql = 'SELECT `komentar` FROM korisnik;';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query($sql);
        $sviKomentari = '';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $komentar = $row['komentar'];
                $sviKomentari .= '"' . $komentar . '",';
            }
        }
        ?>
        
        let komentari = [<?php echo $sviKomentari; ?>]
            .filter(k => k && k.length > 0);
    </script>
    <script defer src="../url-script.js"></script>
    <script defer src="../Chart.bundle.min.js"></script>
    <script defer src="admin-charts.js"></script>
    <style>
        .x {
            color: red;
            font-weight: bold;
            text-decoration: none;
        }
        #komentari {
            list-style-type: square;
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
        <button id="logout" onclick="goto('../akcije/logout.php')">Odjavi se</button>
    </div>
    <div class="container">
        <p>Korisnici koji su popunili anketu (zeleni su validni, a crveni nisu):</p>
        <ul>
            <?php
                $sql = 'SELECT * FROM korisnik;';
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $color = $row['valid'] ? 'green' : 'red';
                        echo "<li style=\"color: $color;\">
                            <a class=\"x\" href=\"../akcije/delete.php?email=$row[email]\">X</a>
                            <a href=\"./details.php?email=$row[email]\">$row[email]</a>
                        </li>";
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
        <p>Mislite li da je vazduh u našem gradu zagađen? (Pitanje 2)</p>
        <canvas id="p1"></canvas>
    </div>
    <div class="container">
        <p>Mislite li da vam je zdravlje ugroženo zbog zagađenog vazduha? (Pitanje 3)</p>
        <canvas id="p2"></canvas>
    </div>
    <div class="container">
        <p>Koliko smatrate da je vazduh zagađen? (Pitanje 4)</p>
        <canvas id="p3"></canvas>
    </div>
    <div class="container">
        <p>Koliko smatrate da je problem zagađenog vazduha rešiv? (Pitanje 5)</p>
        <canvas id="p4"></canvas>
    </div>
    <div class="container">
        <p>Jeste li imali kašalj u poslednje vreme? (Pitanje 6)</p>
        <canvas id="p5"></canvas>
    </div>
    <div class="container">
        <p>Mislite li da naši građani treba da nose maske protiv zagađenog vazduha? (Pitanje 7)</p>
        <canvas id="p6"></canvas>
    </div>
    <div class="container">
        <p>Šta smatrate glavnim razlozima za zagađenost vazduha? (Pitanje 8)</p>
        <canvas id="p7"></canvas>
    </div>
    <div class="container">
        <p>Šta od navedenog smatrate da bi pomoglo kod problema zagađenog vazduha? (Pitanje 9)</p>
        <canvas id="p8"></canvas>
    </div>
    <div class="container">
        <p>Koji gradovi su po vama najzagađeniji? (Pitanje 10)</p>
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
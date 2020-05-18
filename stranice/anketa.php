<?php

session_start();

if (!isset($_SESSION['logged'])) {
    header('Location: registration.php');
    die();
}

$user = $_SESSION['logged'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bangers|Noto+Sans&display=swap">
    <link rel="stylesheet" href="../stilovi/style.css">
    <link rel="stylesheet" href="../stilovi/anketa-style.css">
    <script defer src="../url-script.js"></script>
    <title>Anketa</title>
</head>
<body>
    <div class="head">
        <h1 class="head-title">Anketa</h1>
        <h3>Zagadjenost vazduha</h3>
        <img id="slika" src="../slike/decak-maska.png" alt="decak s maskom">
        <button id="logout" onclick="goto('../akcije/logout.php')">Odjavi se</button>
        <h4 class="user"><?php echo $user; ?></h4>
    </div>

    <div class="super-container">
        <form action="../akcije/anketa-submit.php" method="post">
            <div class="container">
                <p>Brinete li za svoje zdravlje?</p><br/>
                <input type="radio" name="p0" value="da,1"> Da<br>
                <input type="radio" name="p0" value="ne,-1"> Ne<br>
            </div>
            <div class="container">
                <p>Mislite li da je vazduh u našem gradu zagađen?</p><br/>
                <input type="radio" name="p1" value="da,1"> Da<br>
                <input type="radio" name="p1" value="ne,-1"> Ne<br>
            </div>
            <div class="container">
                <p>Mislite li da vam je zdravlje ugroženo zbog zagađenog vazduha?</p><br/>
                <input type="radio" name="p2" value="da,1"> Da<br>
                <input type="radio" name="p2" value="ne,-1"> Ne<br>
            </div>
            <div class="container">
                <p>Koliko smatrate da je vazduh zagađen?</p><br/>
                <select name="p3">
                    <option value="1,-2">1</option>
                    <option value="2,-1">2</option>
                    <option value="3,0">3</option>
                    <option value="4,1">4</option>
                    <option value="5,2">5</option>
                </select>
            </div>
            <div class="container">
                <p>Koliko smatrate da je problem zagađenog vazduga rešiv?</p><br/>
                <select name="p4">
                    <option value="1,-2">1</option>
                    <option value="2,-1">2</option>
                    <option value="3,0">3</option>
                    <option value="4,0">4</option>
                    <option value="5,1">5</option>
                </select>
            </div>
            <div class="container">
                <p>Jeste li imali kašalj u poslednje vreme?</p><br/>
                <input type="radio" name="p5" value="da,1"> Da<br>
                <input type="radio" name="p5" value="ne,0"> Ne<br>
            </div>
            <div class="container">
                <p>Mislite li da naši građani treba da nose maske protiv zagađenog vazduha?</p><br/>
                <input type="radio" name="p6" value="nikako,-3"> Nikako<br>
                <input type="radio" name="p6" value="ne_bas,-2"> Ne bas<br>
                <input type="radio" name="p6" value="mozda,-1"> Mozda<br>
                <input type="radio" name="p6" value="pozeljno,-2"> Pozeljno je<br>
                <input type="radio" name="p6" value="obavezno,3"> Obavezno<br>
            </div>
            <div class="container">
                <p>Šta smatrate glavnim razlozima za zagađenost vazduha?</p><br/>
                <input type="checkbox" name="p7[]" value="fabrike,-1"> Fabrike<br>
                <input type="checkbox" name="p7[]" value="ogrev,2"> Dim od drva za ogrev<br>
                <input type="checkbox" name="p7[]" value="automobili,1"> Dim od automobila<br>
                <input type="checkbox" name="p7[]" value="tekstil,-1"> Tekstilna industrija<br>
            </div>
            <div class="container">
                <p>Šta od navedenog smatrate da bi pomoglo kod problema zagađenog vazduha?</p><br/>
                <input type="checkbox" name="p8[]" value="svest_gradjana,0"> Povećati svest građana o životnoj okolini<br>
                <input type="checkbox" name="p8[]" value="nacin_grejanja,1"> Promena načina grejanja<br>
                <input type="checkbox" name="p8[]" value="ici_pesice,2"> Ići pešice umesto automobilima<br>
                <input type="checkbox" name="p8[]" value="ne_izlaziti_iz_kuce,-1"> Ne izlaziti iz kuce<br>
            </div>
            <div class="container">
                <p>Koji gradovi su po vama najzagađeniji?</p><br/>
                <input type="checkbox" name="p9[]" value="beograd,1"> Beograd<br>
                <input type="checkbox" name="p9[]" value="novi_pazar,-1"> Novi Pazar<br>
                <input type="checkbox" name="p9[]" value="bor,1"> Bor<br>
                <input type="checkbox" name="p9[]" value="sarajevo,2"> Sarajevo<br>
            </div>
            <div class="container">
                <p>Komentar:</p><br/>
                <textarea name="komentar" cols="10" rows="4" placeholder="Napišite svoje mišljenje."></textarea>
            </div>
            <div class="container" id="container-submit">
                <input type="submit" value="submit" id="submit">
            </div>
        </form>
    </div>
</body>
</html>
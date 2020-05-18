<?php

session_start();

if (!$_SESSION["dbhost"]) {
    $_SESSION["redirect"] = './stranice/details.php';
    header('Location: ../config.php');
    die();
}

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "anketa";

$email = $_GET["email"];

if (!isset($_SESSION['admin'])) {
    header('Location: admin-login.php');
    die();
}

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$sql = "SELECT * FROM korisnik WHERE `email`='$email';";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($sql);
if ($result->num_rows == 0) {
    die("No user found.");
}

$user = $result->fetch_assoc();

$valid = $user["valid"];
$validTxt = $valid == 1 ? "valid" : "invalid";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <script src="../url-script.js"></script>
    <style>
        html,
        body {
          height: 1000px;
        }
        body {
          margin: 0;
          background: linear-gradient(45deg, #49a09d, #5f2c82);
          font-family: sans-serif;
          font-weight: 100;
        }
        .container {
          position: absolute;
          top: calc(50% + 100px);
          left: 50%;
          transform: translate(-50%, -50%);
        }
        .header {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            color: white;
        }
        table {
          width: 800px;
          border-collapse: collapse;
          overflow: hidden;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        th,
        td {
          padding: 15px;
          background-color: rgba(255, 255, 255, 0.2);
          color: #fff;
        }
        th {
          text-align: left;
        }
        thead th {
          background-color: #55608f;
        }
        tbody tr:hover {
          background-color: rgba(255, 255, 255, 0.3);
        }
        tbody td {
          position: relative;
        }
        tbody td:hover:before {
          content: "";
          position: absolute;
          left: 0;
          right: 0;
          top: -9999px;
          bottom: -9999px;
          background-color: rgba(255, 255, 255, 0.2);
          z-index: -1;
        }

    </style>
</head>
<body>
    <div class="header">
    <h4 style="display: inline;"><?php echo "$email ($validTxt)"; ?> </h4>
    <button onclick="goto('../akcije/delete.php?email=<?php echo $email; ?>')">DELETE</button>
    <button onclick="goto('../akcije/valid.php?email=<?php echo $email; ?>&valid=<?php echo !$valid; ?>')">
        <?php 
        if ($valid == 1)
            echo "Make invalid";
        else
            echo "Make valid";
        ?>
    </button>
    </div>
    <div class="container">
    <table border="1px">
        <tr>
            <td>Brinete li za svoje zdravlje?</td>
            <td><?php echo $user["p0"] ?></td>
        <tr>
        <tr>
            <td>Mislite li da je vazduh u nasem gradu zagadjen?</td>
            <td><?php echo $user["p1"] ?></td>
        <tr>
        <tr>
            <td>Mislite li da vam je zdravlje ugrozeno zbog zagadjenog vazduha?</td>
            <td><?php echo $user["p2"] ?></td>
        <tr>
        <tr>
            <td>Koliko smatrate da je vazduh zagadjen?</td>
            <td><?php echo $user["p3"] ?></td>
        <tr>
        <tr>
            <td>Koliko smatrate da je problem zagadjenog vazduga resiv?</td>
            <td><?php echo $user["p4"] ?></td>
        <tr>
        <tr>
            <td>Jeste li imali kasalj u poslednje vreme?</td>
            <td><?php echo $user["p5"] ?></td>
        <tr>
        <tr>
            <td>Mislite li da nasi gradjani treba da nose maske protiv zagadjenog vazduha?</td>
            <td><?php echo $user["p6"] ?></td>
        <tr>
        <tr>
            <td>Sta smatrate glavnim razlozima za zagadjenost vazduha?</td>
            <td><?php echo $user["p7"] ?></td>
        <tr>
        <tr>
            <td>Sta od navedenog smatrate da bi pomoglo kod problema zagadjenog vazduga?</td>
            <td><?php echo $user["p8"] ?></td>
        <tr>
        <tr>
            <td>Koji gradovi su po vama najzagadjeniji?</td>
            <td><?php echo $user["p9"] ?></td>
        <tr>
        <tr>
            <td>Komentar:</td>
            <td><?php echo $user["komentar"] ?></td>
        <tr>
    </table>
    </div>
</body>
</html>
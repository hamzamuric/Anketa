<?php

session_start();

if (isset($_SESSION['logged'])) {
    header('Location: anketa.php');
    die();
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
    <link rel="stylesheet" href="../stilovi/registration-style.css">
    <title>Anketa | Login</title>
</head>

<body>
    <div class="head">
        <h1 class="head-title">Anketa</h1>
        <h3>Login | SignUp</h3>
        <img id="slika" src="../slike/decak-maska.png" alt="decak s maskom">
    </div>

    <div class="super-container">
        
        <div class="container">
            <form action="../akcije/login.php" method="post">
                <table>
                    <tr>
                        <td>E-mail:</td>
                        <td><input type="email" name="email" id="email"></td>
                    </tr>
                    <tr>
                        <td>Lozinka</td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="submit-btn" type="submit" value="Uloguj se"></td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="container">
            <form action="../akcije/signup.php" method="post">
                <table>
                    <tr>
                        <td>E-mail:</td>
                        <td><input type="email" name="email" id="email"></td>
                    </tr>
                    <tr>
                        <td>Lozinka</td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr>
                        <td>Ponovite lozinku:</td>
                        <td><input type="password" name="password-again" id="password-again"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="submit-btn" type="submit" value="Registruj se"></td>
                    </tr>
                </table>
            </form>
        </div>

    </div>

</body>

</html>
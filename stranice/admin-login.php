<?php

session_start();

if (isset($_SESSION['admin'])) {
    header('Location: admin.php');
    die();
}

if (isset($_POST['email']) && isset($_POST['password']) && $_POST['email'] == 'admin' && $_POST['password'] == 'admin') {
    session_start();
    $_SESSION['admin'] = TRUE;
    header('Location: admin.php');
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
    <link rel="stylesheet" href="../stilovi/admin-login-style.css">
    <title>Admin</title>
</head>
<body>
    <div class="head">
        <h1 class="head-title">Anketa</h1>
        <h3>Login | SignUp</h3>
        <img id="slika" src="../slike/decak-maska.png" alt="decak s maskom">
    </div>

    <div class="container">
        <form action="../stranice/admin-login.php" method="post">
            <table>
                <tr>
                    <td>E-mail:</td>
                    <td><input type="text" name="email" id="email"></td>
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
</body>
</html>
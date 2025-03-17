<?php
require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryCheckLogin = 'SELECT email, password FROM db_FastRoute.personale WHERE email = :email';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['pwd'])) {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    try {
        $stm = $db->prepare($queryCheckLogin);
        $stm->bindValue(':email', $email);
        $stm->execute();

        // Recupera i dati dell'utente
        $user = $stm->fetch(PDO::FETCH_ASSOC);

        if ($user && $email == $user['email'] && password_verify($password, $user['email'])) {
            header('Location: home.php');
        } else {
            echo 'Credenziali errate';
        }

        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post" action="login.php">
    <br>
    <label for="email"><strong>Email</strong></label>
    <input type="email" name="email" id="email" required>
    <hr>

    <br>
    <label for="pwd"><strong>Password</strong></label>
    <input type="password" name="pwd" id="pwd" required>
    <hr>

    <input type="submit" value="Login">
</form>
</body>
</html>

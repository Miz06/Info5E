<?php
//SESSIONE = durante la sessione posso continuare a far anviare dati tra gli script ovvero farli interagire (https://www.w3schools.com/php/php_sessions.asp)
//i dati di una sessione sono sempre memorizzati nel server e non nel browser A DIFFERENZA DEI COOKIE
//chiudendo il browser si chiude anche la sessione

if(session_status() == PHP_SESSION_NONE){ //CONTROLLO SE LA SESSIONE è ATTIVA
    session_set_cookie_params([
        'lifetime' => 3600,
        'path' => "/",
        'domain' => '',
        'secure' => false,
        'httponly' => false
    ]);
    session_start();
}

$_SESSION['materia'] = 'informatica';
$_SESSION['scuola'] = 'itis';

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
    <p>home page</p>
    <a href="sessionIndexTwo.php">SessionIndexTwo</a>
</body>
</html>

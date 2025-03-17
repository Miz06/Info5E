<?php
//SESSIONE = durante la sessione posso continuare a far anviare dati tra gli script ovvero fari interagire (https://www.w3schools.com/php/php_sessions.asp)
//i dati di una sessione sono sempre memorizzati nel server e non nel browser A DIFFERENZA DEI COOKIE
//chiudendo il browser si chiude anche la sessione

session_start();
$materia = $_SESSION['materia'] = 'informatica';
$scuola = $_SESSION['scuola'] = 'itis';

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
<p>SCUOLA: <?=$scuola?></p>
<p>MATERIA: <?=$materia?></p>

<a href="sessionIndexOne.php">SessionIndexOne</a>
</body>
</html>

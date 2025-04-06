<?php
session_start();

if(!isset($_SESSION['start_time'])){
    $_SESSION['start_time'] = time();
}

$citta = require './citta.php';
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
<form action="index2.php" method="post">
    <?php foreach($citta as $c=>$value){
        echo '<label for="' . $c . '_voto">' . $c . '</label><br>';
        echo '<input type="number" id="' . $c . '_voto" name="' . $c . '_voto" min="1" max="5" value="1" required><br><br>';
    }?>
    <input type="submit" value="Submit">
</form>
</body>
</html>

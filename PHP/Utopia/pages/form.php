<?php

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$nome = $_GET['nome'] ?? '';
$inizio_regno = $_GET['inizio_regno'] ?? '';
$fine_regno = $_GET['fine_regno'] ?? '';
$successore = $_GET['successore'] ?? '';
$predecessore = $_GET['predecessore'] ?? '';

$sovrani = [];

$queryInsertInto = 'insert into db_dinastia_sovrani.sovrani(nome, inizio_regno, fine_regno, successore, predecessore) values (:nome, :inizio_regno, :fine_regno, :successore, :predecessore)';
$querySelect = 'select s.nome from db_dinastia_sovrani.sovrani s';
$queryUpdatePredecessore = 'UPDATE db_dinastia_sovrani.sovrani SET successore = :successore WHERE nome = :predecessore';
$queryUpdateSuccessore = 'UPDATE db_dinastia_sovrani.sovrani SET predecessore = :predecessore WHERE nome = :successore';

try{
        $stm = $db->prepare($queryInsertInto);

        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':inizio_regno', $inizio_regno);
        $stm->bindValue(':fine_regno', $fine_regno);
        $stm->bindValue(':successore', $successore);
        $stm->bindValue(':predecessore', $predecessore);

        $stm->execute();
        $stm->closeCursor();

}catch(Exception $e){
    logError($e);
}

try{
    $stm = $db->prepare($querySelect);
    $stm->execute();
    while ($s = $stm->fetch(PDO::FETCH_ASSOC)) {
        $sovrani[] = $s['nome'];
    }
    $stm->closeCursor();
}catch(Exception $e){
    logError($e);
}


try {
    // Aggiornamento del successore del predecessore
    if (!empty($predecessore) && !empty($successore)) {
        $stm = $db->prepare($queryUpdatePredecessore);
        $stm->bindValue(':successore', $successore);
        $stm->bindValue(':predecessore', $predecessore);
        $stm->execute();
        $stm->closeCursor();
    }
} catch (Exception $e) {
    logError($e);
}

try {
    // Aggiornamento del predecessore del successore
    if (!empty($successore) && !empty($nome)) {
        $stm = $db->prepare($queryUpdateSuccessore);
        $stm->bindValue(':predecessore', $nome);
        $stm->bindValue(':successore', $successore);
        $stm->execute();
        $stm->closeCursor();
    }
} catch (Exception $e) {
    logError($e);
}
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inserimento sovrani</title>
</head>
<body>
<form method="get" action="./form.php">
    <br>
    <label for="nome"><strong>Nome: </strong></label><br><br>
    <input type="text" id="nome" name="nome" required>
    <hr>

    <br>
    <label for="inizio_regno"><strong>Inizio regno: </strong></label><br><br>
    <input type="date" id="inizio_regno" name="inizio_regno" required>
    <hr>

    <br>
    <label for="fine_regno"><strong>Fine regno: </strong></label><br><br>
    <input type="date" id="fine_regno" name="fine_regno" required>
    <hr>

    <br>
    <label for="successore"><strong>Successore: </strong></label><br><br>
    <?php
    foreach ($sovrani as $s) {
        echo "<br><input type='radio' id='successore' name='successore' value='$s'> $s";
    }
    ?>
    <hr>

    <br>
    <label for="predecessore"><strong>Predecessore: </strong></label><br><br>
    <?php
    foreach ($sovrani as $s) {
        echo "<br><input type='radio' id='predecessore' name='predecessore' value='$s'> $s";
    }
    ?>
    <hr>

    <br>
    <input type="submit" class="submi-button" value="Inserisci sovrano">
</form>
</body>
</html>


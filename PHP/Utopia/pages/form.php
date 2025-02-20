<?php

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$nome = $_POST['nome'] ?? '';
$inizio_regno = $_POST['inizio_regno'] ?? '';
$fine_regno = $_POST['fine_regno'] ?? '';
$immagine = $_POST['immagine'] ?? '';

//successore e predecessore se non selezionati, come è ovvio che accadrà per il primo sovrano inserito, asssumeranno valore null direttamente da php
$successore = $_POST['successore'] ?? null;
$predecessore = $_POST['predecessore'] ?? null;

$sovrani = [];

$queryInsertInto = 'insert into db_utopia.sovrani(nome, inizio_regno, fine_regno, immagine, successore, predecessore) values (:nome, :inizio_regno, :fine_regno, :immagine, :successore, :predecessore)';
$querySelect = 'select s.nome from db_utopia.sovrani s';
$queryUpdatePredecessore = 'UPDATE db_utopia.sovrani SET successore = :successore WHERE nome = :predecessore';
$queryUpdateSuccessore = 'UPDATE db_utopia.sovrani SET predecessore = :predecessore WHERE nome = :successore';

try {
    if (!empty($nome) && !empty($inizio_regno) && !empty($fine_regno) && !empty($immagine) && $successore != $predecessore) {
        $stm = $db->prepare($queryInsertInto);

        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':inizio_regno', $inizio_regno);
        $stm->bindValue(':fine_regno', $fine_regno);
        $stm->bindValue(':immagine', $immagine);
        $stm->bindValue(':successore', $successore);
        $stm->bindValue(':predecessore', $predecessore);

        if ($stm->execute()) {
            // Aggiornamento del successore del predecessore
            if (!empty($successore) && !empty($predecessore)) {
                $stm = $db->prepare($queryUpdatePredecessore);
                $stm->bindValue(':successore', $nome);
                $stm->bindValue(':predecessore', $predecessore);
                $stm->execute();
                $stm->closeCursor();
            }

            // Aggiornamento del predecessore del successore
            if (!empty($successore) && !empty($predecessore)) {
                $stm = $db->prepare($queryUpdateSuccessore);
                $stm->bindValue(':predecessore', $nome);
                $stm->bindValue(':successore', $successore);
                $stm->execute();
                $stm->closeCursor();
            }

            header('Location: ./data.php');
        }
        $stm->closeCursor();
    }
} catch
(Exception $e) {
    logError($e);
}

try {
    $stm = $db->prepare($querySelect);
    $stm->execute();
    while ($s = $stm->fetch(PDO::FETCH_ASSOC)) {
        $sovrani[] = $s['nome'];
    }
    $stm->closeCursor();
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
<form method="post" action="./form.php">
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

    <label for="immagine"><strong>Immagine (link): </strong></label><br><br>
    <input type="immagine" id="immagine" name="immagine" required>
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


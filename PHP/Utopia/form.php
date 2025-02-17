<?php

function logError(Exception $e):void{
    error_log($e->getMessage(), 3, 'log/error_log');
}

$nome = $GET['nome'] ?? '';
$inizio_regno = $GET['inizio_regno'] ?? '';
$fine_regno = $GET['fine_regno'] ?? '';

$query = 'insert into db_dinastia_sovrani.sovrani(nome, inizio_regno, fine_regno) values (:nome, :inizio_regno, :fine_regno)';

try{
    $stm = $db->prepare($query);

    $stm->bindValue(':nome', $nome);
    $stm->bindValue(':inizio_regno', $inizio_regno);
    $stm->bindValue(':fine_regno', $fine_regno);

    if($stm->execute()){

    }else{

    }
}catch(Exception $e){
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
</form>
</body>
</html>


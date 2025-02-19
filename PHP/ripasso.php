<?php

$query = 'insert into db_database.table(nome, cognome) values(:nome, :cognome)';

$nome = $_GET['nome']??'';
$cognome = $_GET['cognome']??'';

try{
    $stm=$db->prepare($query);

    $stm->bindValue(':nome', $nome);
    $stm->bindValue(':cognome', $cognome);

    $stm->execute();

    $stm->closeCursor();
}catch(Exception $e){
    logError($e);
}

function logError($e):void{
    error_log($e->getMessage(), 3, 'log/error_log');
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
<form method="get" action="action.php">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome">

    <label for="cognome">Cognome:</label>
    <input type="text" name="cognome" id="cognome">

</form>
</body>
</html>


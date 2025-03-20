<?php

require '../references/functions.php';
require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryInsertSedi = 'INSERT INTO db_FastRoute.sedi (citta, via) VALUES (:citta, :via)';
$queryInsertPersonale = 'INSERT INTO db_FastRoute.personale (email, nome, password, citta, via) VALUES (:email, :nome, :password, :citta, :via)';
$queryInsertStati = 'INSERT INTO db_FastRoute.stati (descrizione) VALUES (:descrizione)';

$sedi = [
    'Milano' => 'Via Roma 10',
    'Roma' => 'Via Genova 20',
    'Genova' => 'Via Firenze 30',
    'Firenze' => 'Via Milano 40',
];

$users = [
    'a@gmail.com' => ['nome' => 'alessandro', 'password' => 'Password1!', 'citta' => 'Milano', 'via' => 'Via Roma 10'],
    'b@gmail.com' => ['nome' => 'beppe', 'password' => 'Password2!', 'citta' => 'Roma', 'via' => 'Via Genova 20'],
    'c@gmail.com' => ['nome' => 'cristiano', 'password' => 'Password3!', 'citta' => 'Genova', 'via' => 'Via Firenze 30'],
    'd@gmail.com' => ['nome' => 'doraemon', 'password' => 'Password4!', 'citta' => 'Firenze', 'via' => 'Via Milano 40'],
];

$stati = [
    'in partenza',
    'in transito',
    'consegnato',
];

foreach($sedi as $citta => $via){
    try{
        $stm = $db->prepare($queryInsertSedi);

        $stm->bindValue(':citta', $citta);
        $stm->bindValue(':via', $via);

        $stm->execute();
        $stm->closeCursor();

        echo 'Sede' . $citta . 'inserita con successo nel DB <br>';
    }catch(Exception $e){
        logError($e);
        echo 'Errore durante l\'inserimento della sede ' . $citta . ': ' . $e->getMessage() . '<br>';
    }
}

echo '<br>';

foreach ($users as $email => $userData) {
    try {
        $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);

        $stm = $db->prepare($queryInsertPersonale);

        $stm->bindValue(':email', $email);
        $stm->bindValue(':nome', $userData['nome']);
        $stm->bindValue(':password', $hashedPassword);
        $stm->bindValue(':citta', $userData['citta']);
        $stm->bindValue(':via', $userData['via']);

        $stm->execute();

        $stm->closeCursor();

        echo 'Utente ' . $email . ' inserito con successo nel DB <br>';
    } catch (Exception $e) {
        logError($e);
        echo 'Errore durante l\'inserimento dell\'utente ' . $email . ': ' . $e->getMessage() . '<br>';
    }
}

echo '<br>';

foreach ($stati as $stato) {
    try {
        $stm = $db->prepare($queryInsertStati);

        $stm->bindValue(':descrizione', $stato);
        $stm->execute();

        $stm->closeCursor();

        echo 'Stato ' . $stato . ' inserito con successo nel DB <br>';
    } catch (Exception $e) {
        logError($e);
        echo 'Errore durante l\'inserimento dello stato "' . $stato . '": ' . $e->getMessage() . '<br>';
    }
}
?>

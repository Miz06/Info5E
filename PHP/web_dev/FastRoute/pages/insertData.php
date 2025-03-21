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
    // Sede Milano
    'a@gmail.com' => ['nome' => 'Alessandro', 'password' => 'Password1!', 'citta' => 'Milano', 'via' => 'Via Roma 10'],
    'b@gmail.com' => ['nome' => 'Beppe', 'password' => 'Password2!', 'citta' => 'Milano', 'via' => 'Via Roma 10'],
    'c@gmail.com' => ['nome' => 'Carlo', 'password' => 'Password3!', 'citta' => 'Milano', 'via' => 'Via Roma 10'],

    // Sede Roma
    'd@gmail.com' => ['nome' => 'Daniela', 'password' => 'Password4!', 'citta' => 'Roma', 'via' => 'Via Genova 20'],
    'e@gmail.com' => ['nome' => 'Emilio', 'password' => 'Password5!', 'citta' => 'Roma', 'via' => 'Via Genova 20'],
    'f@gmail.com' => ['nome' => 'Francesco', 'password' => 'Password6!', 'citta' => 'Roma', 'via' => 'Via Genova 20'],

    // Sede Genova
    'g@gmail.com' => ['nome' => 'Giulia', 'password' => 'Password7!', 'citta' => 'Genova', 'via' => 'Via Firenze 30'],
    'h@gmail.com' => ['nome' => 'Horacio', 'password' => 'Password8!', 'citta' => 'Genova', 'via' => 'Via Firenze 30'],
    'i@gmail.com' => ['nome' => 'Ivan', 'password' => 'Password9!', 'citta' => 'Genova', 'via' => 'Via Firenze 30'],

    // Sede Firenze
    'j@gmail.com' => ['nome' => 'Julia', 'password' => 'Password10!', 'citta' => 'Firenze', 'via' => 'Via Milano 40'],
    'k@gmail.com' => ['nome' => 'Karlo', 'password' => 'Password11!', 'citta' => 'Firenze', 'via' => 'Via Milano 40'],
    'l@gmail.com' => ['nome' => 'Luca', 'password' => 'Password12!', 'citta' => 'Firenze', 'via' => 'Via Milano 40'],
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

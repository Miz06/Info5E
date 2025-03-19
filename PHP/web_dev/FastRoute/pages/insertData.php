<?php

require '../references/functions.php';
require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryInsertSedi = 'INSERT INTO db_FastRoute.sedi (citta, via) VALUES (:citta, :via)';
$queryInsertPersonale = 'INSERT INTO db_FastRoute.personale (email, nome, password, citta, via) VALUES (:email, :nome, :password, :citta, :via)';

$sedi = [
    'Milano' => 'Via Roma 10',
    'Roma' => 'Via Genova 20',
    'Genova' => 'Via Firenze 30',
    'Firenze' => 'Via Milano 40',

];

$users = [
    'a@gmail.com' => ['nome' => 'alessandro', 'password' => 'Password1!'],
    'b@gmail.com' => ['nome' => 'beppe', 'password' => 'Password2!'],
    'c@gmail.com' => ['nome' => 'cristiano', 'password' => 'Password3!'],
    'd@gmail.com' => ['nome' => 'doraemon', 'password' => 'Password4!'],
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
        $stm->bindValue(':citta', 'Milano');
        $stm->bindValue(':via', 'Via Roma 10');

        $stm->execute();

        $stm->closeCursor();

        echo 'Utente ' . $email . ' inserito con successo nel DB <br>';
    } catch (Exception $e) {
        logError($e);
        echo 'Errore durante l\'inserimento dell\'utente ' . $email . ': ' . $e->getMessage() . '<br>';
    }
}
?>

<?php

require '../references/functions.php';
require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryInsertPersonale = 'INSERT INTO db_FastRoute.personale (email, nome, password, citta, via) VALUES (:email, :nome, :password, :citta, :via)';

$users = [
    'a@gmail.com' => ['nome' => 'alessandro', 'password' => 'Password1!'],
    'b@gmail.com' => ['nome' => 'beppe', 'password' => 'Password2!'],
    'c@gmail.com' => ['nome' => 'cristiano', 'password' => 'Password3!'],
    'd@gmail.com' => ['nome' => 'doraemon', 'password' => 'Password4!'],
];

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

        echo 'Utente ' . $email . ' inserito con successo nel DB<br>';
    } catch (Exception $e) {
        logError($e);
        echo 'Errore durante l\'inserimento dell\'utente ' . $email . ': ' . $e->getMessage() . '<br>';
    }
}
?>

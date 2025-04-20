<?php
function logError(PDOException $e): void
{
    error_log($e->getMessage() . '---' . date('Y-m-d H:i:s' . "\n"), 3, '../log/DB_Errors_log');
}

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';;
$db = DBconn::getDB($config);

$queryInsertStudenti = 'INSERT INTO studenti (username, password, nome, cognome) VALUES (:username, :password, :nome, :cognome)';
$queryInsertGenitori = 'INSERT INTO genitori (username, password, nome, cognome, username_studente) VALUES (:username, :password, :nome, :cognome, :username_studente)';
$queryInsertInsegnanti = 'INSERT INTO insegnanti (username, password, nome, cognome) VALUES (:username, :password, :nome, :cognome)';
$queryInsertAmministratori = 'INSERT INTO amministratori (username, password, nome, cognome) VALUES (:username, :password, :nome, :cognome)';

$studenti = [
    'studente1' => ['password' => 'Password1!', 'nome' => 'studente1', 'cognome' => 'Rossi'],
    'studente2' => ['password' => 'Password2!', 'nome' => 'studente2', 'cognome' => 'Verdi'],
    'studente3' => ['password' => 'Password3!', 'nome' => 'studente3', 'cognome' => 'Bianchi'],
];

$insegnanti = [
    'insegnante1' => ['password' => 'Password1!', 'nome' => 'insegnante1', 'cognome' => 'Rossi'],
    'insegnante2' => ['password' => 'Password2!', 'nome' => 'insegnante2', 'cognome' => 'Verdi'],
    'insegnante3' => ['password' => 'Password3!', 'nome' => 'insegnante3', 'cognome' => 'Bianchi'],
];

$genitori = [
    'genitore1' => ['password' => 'Password1!', 'nome' => 'genitore1', 'cognome' => 'Rossi', 'username_studente' => 'studente1'],
    'genitore2' => ['password' => 'Password2!', 'nome' => 'genitore2', 'cognome' => 'Verdi', 'username_studente' => 'studente2'],
    'genitore3' => ['password' => 'Password3!', 'nome' => 'genitore3', 'cognome' => 'Bianchi', 'username_studente' => 'studente3'],
];

$amministratori = [
    'amministratore1' => ['password' => 'Password1!', 'nome' => 'amministratore1', 'cognome' => 'Rossi'],
    'amministratore2' => ['password' => 'Password2!', 'nome' => 'amministratore2', 'cognome' => 'Verdi'],
    'amministratore3' => ['password' => 'Password3!', 'nome' => 'amministratore3', 'cognome' => 'Bianchi'],
];

foreach ($studenti as $username => $s) {
    try {
        $stm = $db->prepare($queryInsertStudenti);

        $hashedPassword = password_hash($s['password'], PASSWORD_DEFAULT);

        $stm->bindValue(':username', $username);
        $stm->bindValue(':password', $hashedPassword);
        $stm->bindValue(':nome', $s['nome']);
        $stm->bindValue(':cognome', $s['cognome']);

        $stm->execute();
        $stm->closeCursor();

        echo 'Studente' . $username . 'inserito con successo nel DB <br>';
    } catch (Exception $e) {
        logError($e);
        echo 'Errore durante l\'inserimento dello studente ' . $username . ': ' . $e->getMessage() . '<br>';
    }
}

echo '<br>';

foreach ($insegnanti as $username => $i) {
    try {
        $stm = $db->prepare($queryInsertInsegnanti);

        $hashedPassword = password_hash($i['password'], PASSWORD_DEFAULT);

        $stm->bindValue(':username', $username);
        $stm->bindValue(':password', $hashedPassword);
        $stm->bindValue(':nome', $i['nome']);
        $stm->bindValue(':cognome', $i['cognome']);

        $stm->execute();
        $stm->closeCursor();

        echo 'Insegnante' . $username . 'inserito con successo nel DB <br>';
    } catch (Exception $e) {
        logError($e);
        echo 'Errore durante l\'inserimento dell\'insegnante ' . $username . ': ' . $e->getMessage() . '<br>';
    }
}

echo '<br>';

foreach ($genitori as $username => $g) {
    try {
        $stm = $db->prepare($queryInsertGenitori);

        $hashedPassword = password_hash($g['password'], PASSWORD_DEFAULT);

        $stm->bindValue(':username', $username);
        $stm->bindValue(':password', $hashedPassword);
        $stm->bindValue(':nome', $g['nome']);
        $stm->bindValue(':cognome', $g['cognome']);
        $stm->bindValue(':username_studente', $g['username_studente']);
        $stm->execute();
        $stm->closeCursor();

        echo 'Genitore' . $username . 'inserito con successo nel DB <br>';
    } catch (Exception $e) {
        logError($e);
        echo 'Errore durante l\'inserimento del genitore ' . $username . ': ' . $e->getMessage() . '<br>';
    }
}

echo '<br>';

foreach ($amministratori as $username => $a) {
    try {
        $stm = $db->prepare($queryInsertAmministratori);

        $hashedPassword = password_hash($a['password'], PASSWORD_DEFAULT);

        $stm->bindValue(':username', $username);
        $stm->bindValue(':password', $hashedPassword);
        $stm->bindValue(':nome', $a['nome']);
        $stm->bindValue(':cognome', $a['cognome']);
        $stm->execute();
        $stm->closeCursor();

        echo 'Amministratore' . $username . 'inserito con successo nel DB <br>';
    } catch (Exception $e) {
        logError($e);
        echo 'Errore durante l\'inserimento del\'amministratore ' . $username . ': ' . $e->getMessage() . '<br>';
    }
}


?>
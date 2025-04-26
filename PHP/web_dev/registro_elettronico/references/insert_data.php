<?php
function logError(PDOException $e): void
{
    error_log($e->getMessage() . '---' . date('Y-m-d H:i:s' . "\n"), 3, '../log/DB_Errors_log');
}

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';;
$db = DBconn::getDB($config);

$queryInsertPersone = 'INSERT INTO persone (username, password, nome, cognome) VALUES (:username, :password, :nome, :cognome)';
$queryInsertGenitoriStudenti = 'INSERT INTO genitori_studenti (username_genitore, username_figlio) VALUES (:username_genitore, :username_figlio)';

$persone = [
    'persona1' => ['password' => 'Password1!', 'nome' => 'persona1', 'cognome' => 'surname'], //genitore
    'persona2' => ['password' => 'Password2!', 'nome' => 'persona2', 'cognome' => 'surname'], //studente
    'persona3' => ['password' => 'Password3!', 'nome' => 'persona3', 'cognome' => 'surname'], //studente
    'persona4' => ['password' => 'Password4!', 'nome' => 'persona4', 'cognome' => 'surname'], //insegnante
    'persona5' => ['password' => 'Password5!', 'nome' => 'persona5', 'cognome' => 'surname'], //amministratore
];

$genitori_studenti = [
    'persona1' => ['persona2', 'persona3'],
];

foreach ($persone as $username => $p) {
    try {
        $stm = $db->prepare($queryInsertPersone);

        $hashedPassword = password_hash($p['password'], PASSWORD_DEFAULT);

        $stm->bindValue(':username', $username);
        $stm->bindValue(':password', $hashedPassword);
        $stm->bindValue(':nome', $p['nome']);
        $stm->bindValue(':cognome', $p['cognome']);

        $stm->execute();
        $stm->closeCursor();

        echo 'Persona ' . $username . 'inserita con successo nel DB <br>';
    } catch (Exception $e) {
        logError($e);
        echo 'Errore durante l\'inserimento della persona ' . $username . ': ' . $e->getMessage() . '<br>';
    }
}

echo '<br>';

foreach ($genitori_studenti as $username_genitore => $figli) {
    foreach ($figli as $username_figlio) {
        try {
            $stm = $db->prepare($queryInsertGenitoriStudenti);
            $stm->bindValue(':username_genitore', $username_genitore);
            $stm->bindValue(':username_figlio', $username_figlio);
            $stm->execute();
            $stm->closeCursor();

            echo "Relazione $username_genitore → $username_figlio inserita con successo<br>";
        } catch (Exception $e) {
            logError($e);
            echo "Errore durante l'inserimento della relazione $username_genitore → $username_figlio: " . $e->getMessage() . "<br>";
        }
    }
}

?>
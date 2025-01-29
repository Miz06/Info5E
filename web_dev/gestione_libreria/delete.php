<?php
$title = 'Delete';
require './connection.php';
require './navbar.php';
require './footer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //la pagina fa riferimento a se stessa per prendere i dati inseriti dall'utente
    $autore = filter_input(INPUT_POST, 'autore', FILTER_SANITIZE_STRING);
//i dati vengono convertiti nel formato specifico

    try {
        $query = 'delete from table_libreria where autore = :autore';
        $stm = $db->prepare($query);
        $stm->bindValue(':autore', $autore);
        if ($stm->execute()) {
            $stm->closeCursor();
        } else {
            throw new PDOException("Errore nella query");
        }
    } catch (Exception $e) {
        logError($e);
    }
    function logError(Exception $e)
    {
        error_log($e->getMessage(), 3, 'log/database_log');
        echo 'A DB error occurred, Try again';
    }
}
?>

<form method="post" action="delete.php">
    <div class="card card-with-bar">
        <h1 style="padding-top: 5%">DELETE</h1>

        <br>
        <label for="autore"><strong>Autore di cui si vogliono eliminare i libri</strong></label>
        <textarea id="autore" name="autore" rows="1" placeholder="..." required></textarea>
        <hr>
    </div>

    <input type="submit" class="submit-button" value="Elimina">
</form>
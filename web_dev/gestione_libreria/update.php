<?php
$title = 'Update';
require './connection.php';
require './navbar.php';
require './footer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prezzo = filter_input(INPUT_POST, 'prezzo', FILTER_VALIDATE_FLOAT);
    $anno_pubblicazione = filter_input(INPUT_POST, 'anno_pubblicazione', FILTER_VALIDATE_INT);
//i dati vengono convertiti nel formato specifico

    try {
        $query = 'update table_libreria set prezzo=:prezzo where anno_pubblicazione=:anno_pubblicazione';
        $stm = $db->prepare($query);
        $stm->bindValue(':prezzo', $prezzo);
        $stm->bindValue(':anno_pubblicazione', $anno_pubblicazione);
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

<form method="post" action="update.php">
    <div class="card card-with-bar">
        <h1 style="padding-top: 5%">UPDATE</h1>

        <br>
        <label for="prezzo"><strong>Prezzo da settare ai libri</strong></label>
        <textarea id="prezzo" name="prezzo" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="anno_pubblicazione"><strong>Anno dei libri a cui deve essere applicato il prezzo</strong></label>
        <textarea id="anno_pubblicazione" name="anno_pubblicazione" rows="1" placeholder="..." required></textarea>
        <hr>
    </div>

    <input type="submit" class="submit-button" value="Aggiorna">
</form>
<?php
$title = 'Create';
require './connection.php';
require './navbar.php';
require './footer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titolo = filter_input(INPUT_POST, 'titolo', FILTER_SANITIZE_STRING);
    $autore = filter_input(INPUT_POST, 'autore', FILTER_SANITIZE_STRING);
    $genere = filter_input(INPUT_POST, 'genere', FILTER_SANITIZE_STRING);
    $prezzo = filter_input(INPUT_POST, 'prezzo', FILTER_VALIDATE_FLOAT);
    $anno_pubblicazione = filter_input(INPUT_POST, 'anno_pubblicazione', FILTER_VALIDATE_INT);
//i dati vengono convertiti nel formato specifico

    try {
        $query = 'insert into table_libreria(titolo, autore, genere, prezzo, anno_pubblicazione) values(:titolo,:autore,:genere,:prezzo, :anno_pubblicazione)';
        $stm = $db->prepare($query);
        $stm->bindValue(':titolo', $titolo);
        $stm->bindValue(':autore', $autore);
        $stm->bindValue(':genere', $genere);
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

<form method="post" action="create.php">
    <div class="card card-with-bar">
        <h1 style="padding-top: 5%">CREATE</h1>

        <br>
        <label for="titolo"><strong>Titolo</strong></label>
        <textarea id="titolo" name="titolo" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="autore"><strong>Autore</strong></label>
        <textarea id="autore" name="autore" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="genere"><strong>Genere</strong></label>
        <textarea id="genere" name="genere" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="prezzo"><strong>Prezzo</strong></label>
        <textarea id="prezzo" name="prezzo" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="anno_pubblicazione"><strong>Anno pubblicazione</strong></label>
        <textarea id="anno_pubblicazione" name="anno_pubblicazione" rows="1" placeholder="..." required></textarea>
        <hr>
    </div>

    <input type="submit" class="submit-button" value="Crea">
</form>
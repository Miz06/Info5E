<?php
$title = 'Iscrizione piloti';

require './connectionToDB.php';
require './navbar.php';

$query = 'select nome from db_campionato_automobilistico.case';
$case = []; // Inizializza un array vuoto

try {
    $stm = $db->prepare($query);
    $stm->execute();

    // Recupera tutte le tuple e le memorizza nell'array
    while ($casa = $stm->fetch(PDO::FETCH_ASSOC)) {
        $case[] = $casa['nome']; // Aggiungi il nome all'array
    }
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

function logError(Exception $e)
{
    error_log($e->getMessage(), 3, 'log/database_log');
    echo 'A DB error occurred, Try again';
}

?>

<form method="post" action="iscrizione_piloti.php">
    <div class="card">
        <h1>Dati pilota</h1>

        <br>
        <label for="nome_pilota"><strong>Nome</strong></label>
        <textarea id="nome_pilota" name="nome_pilota" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="cognome_pilota"><strong>Cognome</strong></label>
        <textarea id="cognome_pilota" name="cognome_pilota" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="nazionalita_pilota"><strong>Nazionalità</strong></label>
        <textarea id="nazionalita_pilota" name="nazionalita_pilota" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="casa_pilota"><strong>Casa</strong></label>
        <br>
        <?php
            foreach($case as $c){
                echo "<br><input type='radio' id='casa_pilota' name='casa_pilota' value='$c'> $c";
            }
        ?>
        <hr>

    </div>
    <input type="submit" class="submit-button" value="ISCRIVI PILOTA">
</form>

<?php require './footer.php';
?>

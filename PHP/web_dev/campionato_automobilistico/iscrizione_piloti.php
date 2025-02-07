<?php
$title = 'Iscrizione piloti';

require './connectionToDB.php';
require './navbar.php';

$queryInsert = 'insert into db_campionato_automobilistico.piloti(nome, cognome, nazionalita, vittorie, nome_casa) values(:nome,:cognome,:nazionalita, :vittorie, :nome_casa);';
$querySelect = 'select nome from db_campionato_automobilistico.case_automobilistiche';
$case = []; //inizializzazione dell'arra contenente le case automobilistiche

try {
    $stm = $db->prepare($querySelect);
    $stm->execute();

    // Recupera tutte le case del db e le memorizza nell'array
    while ($c = $stm->fetch(PDO::FETCH_ASSOC)) {
        $case[] = $c['nome'];
    }
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $cognome = filter_input(INPUT_POST, 'cognome', FILTER_SANITIZE_STRING);
    $nazionalita = filter_input(INPUT_POST, 'nazionalita', FILTER_SANITIZE_STRING);
    $vittorie = filter_input(INPUT_POST, 'vittorie', FILTER_SANITIZE_NUMBER_INT);
    $nome_casa = $_POST['nome_casa']??''; //non occorre un controllo in quanto il dato viene inserito da un radiobutton

    try {
        $stm = $db->prepare($queryInsert);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':cognome', $cognome);
        $stm->bindValue(':nazionalita', $nazionalita);
        $stm->bindValue(':vittorie', $vittorie);
        $stm->bindValue(':nome_casa', $nome_casa);
        if ($stm->execute()) {
            $stm->closeCursor();
        } else {
            throw new PDOException("Errore nella query");
        }
    } catch (Exception $e) {
        logError($e);
    }

    header('Location: ./confirm.html');
}

function logError(Exception $e):void
{
    error_log($e->getMessage(), 3, 'log/database_log');
}

?>

<form method="post" action="iscrizione_piloti.php">
    <div class="card">
        <h1>Dati pilota</h1>

        <br>
        <label for="nome"><strong>Nome</strong></label>
        <textarea id="nome" name="nome" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="cognome"><strong>Cognome</strong></label>
        <textarea id="cognome" name="cognome" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="nazionalita"><strong>Nazionalità</strong></label>
        <textarea id="nazionalita" name="nazionalita" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="vittorie"><strong>Vittorie</strong></label>
        <textarea id="vittorie" name="vittorie" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="nome_casa"><strong>Casa</strong></label>
        <br>
        <?php
            foreach($case as $c){
                echo "<br><input type='radio' id='nome_casa' name='nome_casa' value='$c'> $c";
            }
        ?>
        <hr>

    </div>
    <input type="submit" class="submit-button" value="ISCRIVI PILOTA">
</form>

<?php require './footer.php';
?>

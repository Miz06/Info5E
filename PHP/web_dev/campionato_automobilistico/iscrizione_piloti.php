<?php
$title = 'Iscrizione piloti';

require './connectionToDB.php';
require './navbar.php';

$queryInsert = 'insert into db_campionato_automobilistico.piloti(nome, cognome, nazionalita, vittorie, nome_casa) values(:nome,:cognome,:nazionalita, :vittorie, :nome_casa);';
$querySelectCase = 'select nome from db_campionato_automobilistico.case_automobilistiche';
$querySelectGare = 'select data, luogo from db_campionato_automobilistico.gare';

$case = []; //inizializzazione dell'array contenente le case automobilistiche
$gare = []; //array gare

function logError(Exception $e):void
{
    error_log($e->getMessage(), 3, 'log/database_log');
}

try {
    $stm = $db->prepare($querySelectCase);
    $stm->execute();
    while ($c = $stm->fetch(PDO::FETCH_ASSOC)) {
        $case[] = $c['nome'];
    }
    $stm->closeCursor();

    $stm = $db->prepare($querySelectGare);
    $stm->execute();
    while ($g = $stm->fetch(PDO::FETCH_ASSOC)) {
        $gare[] = $g['luogo'] . ' - ' . $g['data'];
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

        <br>
        <label for="gara"><strong>Gare a cui parteciperà</strong></label>
        <br>
        <?php
        foreach($gare as $g){
            echo "<br><input type='radio' id='gara' name='gara' value='$g'> $g";
        }
        ?>
        <hr>

    </div>
    <input type="submit" class="submit-button" value="ISCRIVI PILOTA">
</form>

<?php require './footer.php';
?>

<?php
$title = 'Iscrizione case';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

require '../references/navbar.php';

$query = 'insert into db_campionato_automobilistico.case_automobilistiche(nome, colore) values(:nome, :colore);';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $colore = filter_input(INPUT_POST, 'colore', FILTER_SANITIZE_STRING);

    try {
        $stm = $db->prepare($query);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':colore', $colore);
        if ($stm->execute()) {
            $stm->closeCursor();
            header('Location: ../references/confirm.html');
        } else {
            throw new PDOException("Errore nella query");
        }
    } catch (Exception $e) {
        logError($e);
    }
}
?>

<form method="post" action="iscrizione_case.php">
    <div class="card">
        <h1>Dati casa</h1>

        <br>
        <label for="nome"><strong>Nome</strong></label>
        <textarea id="nome" name="nome" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="colore"><strong>Colore</strong></label>
        <textarea id="colore" name="colore" rows="1" placeholder="..." required></textarea>
        <hr>
    </div>

    <input type="submit" class="submit-button" value="ISCRIVI CASA">
</form>

<?php require '../references/footer.php';
?>

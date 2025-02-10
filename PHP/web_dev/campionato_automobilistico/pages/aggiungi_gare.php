<?php
$title = 'Aggiungi gare';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

require '../references/navbar.php';

$query = 'insert into db_campionato_automobilistico.gare(data, luogo, tempo_veloce) values(:data, :luogo, :tempo_veloce);';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
    $luogo = filter_input(INPUT_POST, 'luogo', FILTER_SANITIZE_STRING);

    try {
        $stm = $db->prepare($query);

        $ore = 0;
        $minuti = rand(0, 59);
        $secondi = rand(0, 59);

        $tempo_migliore = sprintf('%02d:%02d:%02d', $ore, $minuti, $secondi); // Formatta il tempo in H:i:s
        //sprintf consente di resistuire ore minuti e secondi come un valore unico
        //%02d sta a significare che il valore della variabile deve essere di almeno due cifre e che se così non sarà verrà messo uno 0 ove necessario

        $stm->bindValue(':data', $data);
        $stm->bindValue(':luogo', $luogo);
        $stm->bindValue(':tempo_veloce', $tempo_migliore);

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

<form method="post" action="aggiungi_gare.php">
    <div class="card">
        <h1>Dati gara</h1>

        <br>
        <label for="data"><strong>Data e ora</strong></label><br><br>
        <input type="datetime-local" id="data" name="data" required>
        <hr>

        <br>
        <label for="luogo"><strong>Luogo</strong></label>
        <textarea id="luogo" name="luogo" rows="1" placeholder="..." required></textarea>
        <hr>
    </div>

    <input type="submit" class="submit-button" value="AGGIUNGI GARA">
</form>

<?php require '../references/footer.php';
?>

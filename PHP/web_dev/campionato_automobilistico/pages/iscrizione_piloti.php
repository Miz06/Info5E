<?php
$title = 'Iscrizione piloti';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

require '../references/navbar.php';

$queryInsertIntoPiloti = 'insert into db_campionato_automobilistico.piloti(nome, cognome, nazionalita, vittorie, nome_casa) values(:nome,:cognome,:nazionalita, :vittorie, :nome_casa);';
$querySelectCase = 'select nome from db_campionato_automobilistico.case_automobilistiche';
$querySelectGare = 'select data, luogo from db_campionato_automobilistico.gare';
$queryInsertIntoGareggiare = 'insert into db_campionato_automobilistico.gareggiare(id_pilota, luogo_gara, data_gara, tempo) values(:id_pilota, :luogo_gara, :data_gara, :tempo)';
$queryInsertIntoPartecipare = 'insert into db_campionato_automobilistico.partecipare(nome_casa, luogo_gara, data_gara) values(:nome_casa, :luogo_gara, :data_gara)';

$case = []; //inizializzazione array case automobilistiche (utilizzato nella checkbox del form)
$gareDisponibili = []; //inizializzazione array gare disponibili (utilizzato nella checkbox del form)

try {
    //select case
    $stm = $db->prepare($querySelectCase);
    $stm->execute();
    while ($c = $stm->fetch(PDO::FETCH_ASSOC)) {
        $case[] = $c['nome'];
    }
    $stm->closeCursor();

    //select gare
    $stm = $db->prepare($querySelectGare);
    $stm->execute();
    while ($g = $stm->fetch(PDO::FETCH_ASSOC)) {
        $gareDisponibili[] = $g['luogo'] . ' - ' . $g['data'];
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
    $nome_casa = $_POST['nome_casa'] ?? '';
    $gare = $_POST['gara'] ?? [];

    try {
        $stm = $db->prepare($queryInsertIntoPiloti);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':cognome', $cognome);
        $stm->bindValue(':nazionalita', $nazionalita);
        $stm->bindValue(':vittorie', $vittorie);
        $stm->bindValue(':nome_casa', $nome_casa);

        if ($stm->execute()) {
            $id = $db->lastInsertId(); // recupera l'Id del pilota appena inserito

            foreach ($gare as $race) { // inserimento all'interno di gareggiare per ogni gara a cui parteciperà il pilota
                list($luogo_gara, $data_gara) = explode(' - ', $race);

                $ore = rand(1, 2);
                $minuti = rand(0, 59);
                $secondi = rand(0, 59);
                $tempo = sprintf('%02d:%02d:%02d', $ore, $minuti, $secondi); // Formatta il tempo in H:i:s

                // controllo necessario a non creare un errore si sdoppiamento di una tupla: verifica che la tupla che si desidera inserire non sia già presente
                // fetchColoumn() consente di recuperare il valore della prima riga della colonna specificata (di default è la colonna in posizione 0)
                $queryCheckGareggiare = 'SELECT COUNT(*) FROM db_campionato_automobilistico.gareggiare WHERE id_pilota = :id_pilota AND luogo_gara = :luogo_gara AND data_gara = :data_gara';
                $stmCheckGareggiare = $db->prepare($queryCheckGareggiare);
                $stmCheckGareggiare->bindValue(':id_pilota', $id);
                $stmCheckGareggiare->bindValue(':luogo_gara', $luogo_gara);
                $stmCheckGareggiare->bindValue(':data_gara', $data_gara);
                $stmCheckGareggiare->execute();
                $countGareggiare = $stmCheckGareggiare->fetchColumn();

                if ($countGareggiare == 0) {
                    // Inserimento in gareggiare
                    $stmGareggiare = $db->prepare($queryInsertIntoGareggiare);
                    $stmGareggiare->bindValue(':id_pilota', $id);
                    $stmGareggiare->bindValue(':luogo_gara', $luogo_gara);
                    $stmGareggiare->bindValue(':data_gara', $data_gara);
                    $stmGareggiare->bindValue(':tempo', $tempo);
                    $stmGareggiare->execute();
                    $stmGareggiare->closeCursor();
                }

                $queryCheckPartecipare = 'SELECT COUNT(*) FROM db_campionato_automobilistico.partecipare WHERE nome_casa = :nome_casa AND luogo_gara = :luogo_gara AND data_gara = :data_gara';
                $stmCheckPartecipare = $db->prepare($queryCheckPartecipare);
                $stmCheckPartecipare->bindValue(':nome_casa', $nome_casa);
                $stmCheckPartecipare->bindValue(':luogo_gara', $luogo_gara);
                $stmCheckPartecipare->bindValue(':data_gara', $data_gara);
                $stmCheckPartecipare->execute();
                $countPartecipare = $stmCheckPartecipare->fetchColumn();

                if ($countPartecipare == 0) {
                    // Inserimento in partecipare
                    $stmPartecipare = $db->prepare($queryInsertIntoPartecipare);
                    $stmPartecipare->bindValue(':nome_casa', $nome_casa);
                    $stmPartecipare->bindValue(':luogo_gara', $luogo_gara);
                    $stmPartecipare->bindValue(':data_gara', $data_gara);
                    $stmPartecipare->execute();
                    $stmPartecipare->closeCursor();
                }
            }

            $stm->closeCursor();
            header('Location: ../references/confirm.html');
        } else {
            throw new PDOException("Errore nella query");
        }
    } catch
    (Exception $e) {
        logError($e);
    }
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
            foreach ($case as $c) {
                echo "<br><input type='radio' id='nome_casa' name='nome_casa' value='$c'> $c";
            }
            ?>
            <hr>

            <br>
            <label for="gara"><strong>Gare a cui parteciperà</strong></label>
            <br>
            <?php
            foreach ($gareDisponibili as $g) {
                echo "<br><input type='checkbox' id='gara' name='gara[]' value='$g'> $g";
            }
            ?>
            <hr>
        </div>
        <input type="submit" class="submit-button" value="ISCRIVI PILOTA">
    </form>

<?php require '../references/footer.php'; ?>
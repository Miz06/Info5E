<?php
$title = 'nuovo plico';
require '../references/navbar.php';

$config = $_SESSION['config']; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$querySelectPersonale = 'SELECT * FROM db_FastRoute.personale';
$querySelectSedi = 'SELECT * FROM db_FastRoute.sedi';
$querySelectClienti = 'SELECT * FROM db_FastRoute.clienti';
$querySelectDestinatari = 'SELECT * FROM db_FastRoute.destinatari';

$querySelectPersonaleSede = 'SELECT * FROM db_FastRoute.personale WHERE citta = :citta AND via = :via';

$queryInsertPlico = 'INSERT INTO db_FastRoute.consegnare (data_consegna, ora_consegna, telefono_mittente, id_plico) values (:data_consegna, :ora_consegna, :telefono_mittente, :id_plico)';
$queryInsertDestinatario = 'INSERT INTO db_FastRoute.destinatari (nome, cognome, CF) values (:nome_destinatario, :cognome_destinatario, :CF_destinatario)';

$contatti_personale = [];
$sedi = [];
$clienti = [];
$destinatari = [];

//PERSONALE
try {
    $stm = $db->prepare($querySelectPersonale);
    $stm->execute();

    $contatti_personale = $stm->fetchAll(PDO::FETCH_ASSOC);

    $stm->CloseCursor();
} catch (Exception $e) {
    logError($e);
}

//SEDI
try {
    $stm = $db->prepare($querySelectSedi);
    $stm->execute();

    $sedi = $stm->fetchAll(PDO::FETCH_ASSOC);

    $stm->CloseCursor();
} catch (Exception $e) {
    logError($e);
}

//CLIENTI
try {
    $stm = $db->prepare($querySelectClienti);
    $stm->execute();

    $clienti = $stm->fetchAll(PDO::FETCH_ASSOC);

    $stm->CloseCursor();
} catch (Exception $e) {
    logError($e);
}

//DESTINATARI
try {
    $stm = $db->prepare($querySelectDestinatari);
    $stm->execute();

    $destinatario = $stm->fetchAll(PDO::FETCH_ASSOC);
    //$destinatario è utilizzata successivamente per verificare che il destinatario non sia già stato registrato nel db

    $stm->CloseCursor();

} catch (Exception $e) {
    logError($e);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /*
    try {
        $stm = $db->prepare($queryInsertPlico);

        $stm->bindValue(':data_consegna', $_POST['data_consegna']);
        $stm->bindValue(':ora_consegna', $_POST['ora_consegna']);
        $stm->bindValue(':telefono_mittente', $_POST['telefono_mittente']);
        $stm->bindValue(':id_plico', $_POST['id_plico']);

        $stm->execute();
        $stm->CloseCursor();
    } catch (Exception $e) {
        logError($e);
    }
*/
    if (empty($destinatario) && isset($_POST['nome_destinatario']) && isset($_POST['cognome_destinatario']) && isset($_POST['CF_destinatario'])) {
        $nome_destinatario = $_POST['nome_destinatario'];
        $cognome_destinatario = $_POST['cognome_destinatario'];
        $CF_destinatario = $_POST['CF_destinatario'];

        try {
            $stm = $db->prepare($queryInsertDestinatario);
            $stm->bindValue(':nome_destinatario', $nome_destinatario);
            $stm->bindValue(':cognome_destinatario', $cognome_destinatario);
            $stm->bindValue(':CF_destinatario', $CF_destinatario);
            $stm->execute();
            $stm->CloseCursor();
        } catch (Exception $e) {
            logError($e);
        }
    }
}

?>

<form method="post" action="nuovo_plico.php">
    <h3>Informazioni relative alla gestione del plico</h3>
    <h6>1) Il cliente consegna il pacco in sede [data e ora registrate]</h6>
    <h6>2) Un membro del personale registra e immagazzina il plico </h6>
    <h6>3) Il plico viene spedito da un membro del personale in un altra sede [data e ora registrate]</h6>
    <h6>4) Il plico è recapitato da un membro del personale </h6>
    <h6>5) Il destinatario ritira il plico [data e ora registrate]</h6>


    <br>
    <label for="contatto_spedizione"><strong>Email dell'addetto alla spedizione </strong></label>
    <?php foreach ($contatti_personale as $contatto_personale) {
        echo '<br><input type="radio" id="contatto_spedizione' . $contatto_personale['email'] . '"name="contatto_spedizione" value="' . $contatto_personale['email'] . '">
              <label for="contatto_spedizione' . $contatto_personale['email'] . '">' . $contatto_personale['nome'] . ' (' . $contatto_personale['email'] . ')</label>'; //label che fa riferimento alla prima per consentire una maggiore usabilità
    } ?>

    <br>
    <br>
    <label for="sede"><strong>In quale sede verrà spedito il pacco? </strong></label>
    <?php foreach ($sedi as $sede) {
        echo '<br><input type="radio" id="sede_' . $sede['citta'] . '_' . $sede['via'] . '" name="sede" value="' . $sede['citta'] . '-' . $sede['via'] . '">
              <label for="sede_' . $sede['citta'] . '_' . $sede['via'] . '">' . $sede['citta'] . ' - ' . $sede['via'] . '</label>'; //seconda label che fa riferimento alla prima per consentire una maggiore usabilità
    } ?>

    <br>
    <br>
    <label for="contatto_recapito"><strong>Email dell'addetto al recapito </strong></label>
    <?php foreach ($contatti_personale as $contatto_personale) {
        echo '<br><input type="radio" id="contatto_recapito' . $contatto_personale['email'] . '"name="contatto_recapito" value="' . $contatto_personale['email'] . '">
              <label for="contatto_recapito' . $contatto_personale['email'] . '">' . $contatto_personale['nome'] . ' (' . $contatto_personale['email'] . ')</label>'; //seconda label che fa riferimento alla prima per consentire una maggiore usabilità
    } ?>

    <br>
    <br>
    <label for="contatto_ritiro"><strong>Email dell'addetto al ritiro </strong></label>
    <?php foreach ($contatti_personale as $contatto_personale) {
        echo '<br><input type="radio" id="contatto_ritiro' . $contatto_personale['email'] . '"name="contatto_ritiro" value="' . $contatto_personale['email'] . '">
              <label for="contatto_ritiro' . $contatto_personale['email'] . '">' . $contatto_personale['nome'] . ' (' . $contatto_personale['email'] . ')</label>'; //seconda label che fa riferimento alla prima per consentire una maggiore usabilità
    } ?>

    <br>
    <br>
    <h3>Destinatario</h3>

    <br>
    <label for="nome_destinatario"><strong>Nome</strong></label>
    <input type="text" id="nome_destinatario" name="nome_destinatario" required>

    <br>
    <label for="cognome_destinatario"><strong>Cognome</strong></label>
    <input type="text" id="cognome_destinatario" name="cognome_destinatario" required>

    <br>
    <label for="CF_destinatario"><strong>Codice fiscale</strong></label>
    <input type="text" id="CF_destinatario" name="CF_destinatario" required>

    <br>
    <br>
    <input type="submit" value="Submit">
    <hr>
</form>


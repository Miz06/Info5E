<?php
$title = 'nuovo plico';
require '../references/navbar.php';

$config = $_SESSION['config']; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$querySelectPersonale = 'SELECT * FROM db_FastRoute.personale';
$querySelectSedi = 'SELECT * FROM db_FastRoute.sedi';

$querySelectCliente = 'SELECT * FROM db_FastRoute.clienti WHERE email = :email';
$querySelectDestinatario = 'SELECT * FROM db_FastRoute.destinatari WHERE CF = :CF';
$querySelectPersonaleSede = 'SELECT * FROM db_FastRoute.personale WHERE citta = :citta AND via = :via';

$queryInsertPlico = 'INSERT INTO db_FastRoute.plichi (email_personale_magazziniere, email_personale_recapito, email_mittente, CF_destinatario) values (:email_personale_magazziniere, :email_personale_recapito, :email_mittente, :CF_destinatario)';
$queryInsertDestinatario = 'INSERT INTO db_FastRoute.destinatari (nome, cognome, CF) values (:nome_destinatario, :cognome_destinatario, :CF_destinatario)';
$queryInsertCliente = "INSERT INTO db_FastRoute.clienti (nome, cognome, indirizzo, telefono, email, email_personale) values (:nome_mittente, :cognome_mittente, :indirizzo_mittente, :telefono_mittente, :email_mittente, :email_personale)";

$queryUpdatePunteggio = 'UPDATE db_FastRoute.clienti SET punteggio = punteggio+1 WHERE email = :email';

$queryInsertConsegnare = 'INSERT INTO db_FastRoute.consegnare (email_mittente, id_plico) values (:email_mittente, :id_plico)';
$queryInsertSpedire = 'INSERT INTO db_FastRoute.spedire (email_personale, id_plico) values (:email_personale, :id_plico)';
$queryInsertRitirare = 'INSERT INTO db_FastRoute.ritirare (CF, id_plico) values (:CF, :id_plico)';

//$contatti_personale = [];
//$sedi = [];

try {
    //SELECT PERSONALE
    $stm = $db->prepare($querySelectPersonale);
    $stm->execute();
    $contatti_personale = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->CloseCursor();

    //SELECT SEDI
    $stm = $db->prepare($querySelectSedi);
    $stm->execute();
    $sedi = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->CloseCursor();

    //$destinatario e $cliente sono utilizzati successivamente per verificare l'eventuale presenza, o meno, nel db
} catch (Exception $e) {
    logError($e);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //SELECT CLIENTI
    $stm = $db->prepare($querySelectCliente);
    $stm->bindValue(':email', $_POST['email_mittente']);
    $stm->execute();
    $cliente = $stm->fetch(PDO::FETCH_ASSOC);
    $stm->CloseCursor();

    //SELECT DESTINATARI
    $stm = $db->prepare($querySelectDestinatario);
    $stm->bindValue(':CF', $_POST['CF_destinatario']);
    $stm->execute();
    $destinatario = $stm->fetch(PDO::FETCH_ASSOC);
    $stm->CloseCursor();

    //INSERT CLIENTE
    if (!$cliente && isset($_POST['nome_mittente']) && isset($_POST['cognome_mittente']) && isset($_POST['indirizzo_mittente']) && isset($_POST['telefono_mittente']) && isset($_POST['email_mittente'])) {
        try {
            $stm = $db->prepare($queryInsertCliente);

            $stm->bindValue(':nome_mittente', $_POST['nome_mittente']);
            $stm->bindValue(':cognome_mittente', $_POST['cognome_mittente']);
            $stm->bindValue(':indirizzo_mittente', $_POST['indirizzo_mittente']);
            $stm->bindValue(':telefono_mittente', $_POST['telefono_mittente']);
            $stm->bindValue(':email_mittente', $_POST['email_mittente']);
            $stm->bindValue(':email_personale', $_SESSION['email']);

            $stm->execute();
            $stm->closeCursor();
        } catch (Exception $e) {
            logError($e);
        }
    }

    //INSERT DESTINATARIO
    if (!$destinatario && isset($_POST['nome_destinatario']) && isset($_POST['cognome_destinatario']) && isset($_POST['CF_destinatario'])) {
        try {
            $stm = $db->prepare($queryInsertDestinatario);
            $stm->bindValue(':nome_destinatario', $_POST['nome_destinatario']);
            $stm->bindValue(':cognome_destinatario', $_POST['cognome_destinatario']);
            $stm->bindValue(':CF_destinatario', $_POST['CF_destinatario']);
            $stm->execute();
            $stm->CloseCursor();
        } catch (Exception $e) {
            logError($e);
        }
    }

    //INSERT PLICO
    if (isset($_POST['contatto_recapito']) && isset($_POST['contatto_spedizione']) && isset($_POST['CF_destinatario']) && isset($_POST['email_mittente'])) {
        $contatto_recapito = $_POST['contatto_recapito'];
        $contatto_spedizione = $_POST['contatto_spedizione'];
        $CF_destinatario = $_POST['CF_destinatario'];
        $email_mittente = $_POST['email_mittente'];

        try {
            $stm = $db->prepare($queryInsertPlico);
            $stm->bindValue(':email_personale_magazziniere', $_SESSION['email']);
            $stm->bindValue(':email_personale_recapito', $contatto_recapito);
            $stm->bindValue(':CF_destinatario', $CF_destinatario);
            $stm->bindValue(':email_mittente', $email_mittente);
            $stm->execute();
            // Ottieni l'ID dell'ultimo plico inserito
            $id_plico = $db->lastInsertId();
            $stm->CloseCursor();

            // AGGIORNAMENTO PUNTEGGIO CLIENTE
            if (isset($email_mittente)) {
                try {
                    $stm = $db->prepare($queryUpdatePunteggio);
                    $stm->bindValue(':email', $email_mittente);
                    $stm->execute();
                    $stm->CloseCursor();
                } catch (Exception $e) {
                    logError($e);
                }
            }

            // INSERT INTO CONSEGNARE
            if (isset($email_mittente) && isset($id_plico)) {
                try {
                    $stm = $db->prepare($queryInsertConsegnare);
                    $stm->bindValue(':email_mittente', $email_mittente);
                    $stm->bindValue(':id_plico', $id_plico);
                    $stm->execute();
                    $stm->CloseCursor();
                } catch (Exception $e) {
                    logError($e);
                }
            }

            // INSERT INTO SPEDIRE
            // (solamente l'incaricato alla consegna del plico in quanto data e ora vengono inseriti al momento in cui il membro del personale cambia lo stato in 'in transito')
            if (isset($contatto_spedizione) && isset($id_plico)) {
                try {
                    $stm = $db->prepare($queryInsertSpedire);
                    $stm->bindValue(':email_personale', $contatto_spedizione);
                    $stm->bindValue(':id_plico', $id_plico);
                    $stm->execute();
                    $stm->CloseCursor();
                } catch (Exception $e) {
                    logError($e);
                }
            }

            // INSERT INTO RITIRARE
            if (isset($CF_destinatario) && isset($id_plico)){
                try {
                    $stm = $db->prepare($queryInsertRitirare);
                    $stm->bindValue(':CF', $CF_destinatario);
                    $stm->bindValue(':id_plico', $id_plico);
                    $stm->execute();
                    $stm->closeCursor();
                } catch (Exception $e) {
                    logError($e);
                }
            }
        } catch (Exception $e) {
            logError($e);
        }
    }

    header('Location: ./info.php');
}
?>

<form method="post" action="nuovo_plico.php">
    <div class="element">
    <h4>Informazioni relative alla gestione del plico</h4>
    <hr>
    <h6>1) Il cliente consegna il pacco in sede [data e ora registrate]</h6>
    <h6>2) Un membro del personale registra e immagazzina il plico </h6>
    <h6>3) Il plico viene spedito da un membro del personale in un altra sede [data e ora registrate]</h6>
    <h6>4) Il plico è recapitato da un membro del personale </h6>
    <h6>5) Il destinatario ritira il plico [data e ora registrate]</h6>
    </div>

    <div class="element">
    <h4><label for="contatto_spedizione">Email dell'addetto alla spedizione</label></h4>
    <hr>
    <?php foreach ($contatti_personale as $contatto_personale) {
        echo '<input type="radio" id="contatto_spedizione' . $contatto_personale['email'] . '"name="contatto_spedizione" value="' . $contatto_personale['email'] . '">
              <label for="contatto_spedizione' . $contatto_personale['email'] . '">' . $contatto_personale['nome'] . ' (' . $contatto_personale['email'] . ')</label><br>'; //label che fa riferimento alla prima per consentire una maggiore usabilità
    } ?>
    </div>

    <div class="element">
    <h4><label for="sede">In quale sede verrà spedito il pacco?</label></h4>
    <hr>
    <?php foreach ($sedi as $sede) {
        echo '<input type="radio" id="sede_' . $sede['citta'] . '_' . $sede['via'] . '" name="sede" value="' . $sede['citta'] . '-' . $sede['via'] . '">
              <label for="sede_' . $sede['citta'] . '_' . $sede['via'] . '">' . $sede['citta'] . ' - ' . $sede['via'] . '</label><br>'; //seconda label che fa riferimento alla prima per consentire una maggiore usabilità
    } ?>
    </div>

    <div class="element">
    <h4><label for="contatto_recapito">Email dell'addetto al recapito </label></h4>
    <hr>
    <?php foreach ($contatti_personale as $contatto_personale) {
        echo '<input type="radio" id="contatto_recapito' . $contatto_personale['email'] . '"name="contatto_recapito" value="' . $contatto_personale['email'] . '">
              <label for="contatto_recapito' . $contatto_personale['email'] . '">' . $contatto_personale['nome'] . ' (' . $contatto_personale['email'] . ')</label><br>'; //seconda label che fa riferimento alla prima per consentire una maggiore usabilità
    } ?>
    </div>

    <div class="element">
    <h4>Cliente mittente</h4>
    <hr

    <br>
    <label for="nome_mittente"><strong>Nome</strong></label>
    <input type="text" id="nome_mittente" name="nome_mittente" required>

    <br>
    <label for="cognome_mittente"><strong>Cognome</strong></label>
    <input type="text" id="cognome_mittente" name="cognome_mittente" required>

    <br>
    <label for="email_mittente"><strong>Email</strong></label>
    <input type="text" id="email_mittente" name="email_mittente" required>

    <br>
    <label for="telefono_mittente"><strong>Telefono</strong></label>
    <input type="text" id="telefono_mittente" name="telefono_mittente" required>

    <br>
    <label for="indirizzo_mittente"><strong>Indirizzo</strong></label>
    <input type="text" id="indirizzo_mittente" name="indirizzo_mittente" required>
    </div>

    <div class="element">
    <h4>Destinatario</h4>
    <hr

    <br>
    <label for="nome_destinatario"><strong>Nome</strong></label>
    <input type="text" id="nome_destinatario" name="nome_destinatario" required>

    <br>
    <label for="cognome_destinatario"><strong>Cognome</strong></label>
    <input type="text" id="cognome_destinatario" name="cognome_destinatario" required>

    <br>
    <label for="CF_destinatario"><strong>Codice fiscale</strong></label>
    <input type="text" id="CF_destinatario" name="CF_destinatario" required>
    </div>

    <br>
    <br>
    <input type="submit" value="Submit">
</form>


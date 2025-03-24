<?php
ob_start();
$title = 'info plichi';
require '../references/navbar.php';
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer; //inclusione libreria per usare la classe PHPmailer
use PHPMailer\PHPMailer\Exception; //gestore delle eccezioni

$config = require '../connectionToDB/databaseConfig.php';; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$querySelectPlichi = 'SELECT * FROM db_FastRoute.plichi';
$querySelectStati = 'SELECT * FROM db_FastRoute.stati';
$queryCambiaStato = 'UPDATE db_FastRoute.plichi SET stato = :stato WHERE id = :id';

$queryUpdateSpedire = 'UPDATE db_FastRoute.spedire SET data_spedizione = :data_spedizione, ora_spedizione = :ora_spedizione WHERE id_plico = :id_plico';
$queryUpdateRitirare = 'UPDATE db_FastRoute.ritirare SET data_ritiro = :data_ritiro, ora_ritiro = :ora_ritiro WHERE id_plico = :id_plico';

$querySelectPlichiGiorni = 'SELECT data_consegna, COUNT(*) as numero_consegne FROM db_FastRoute.consegnare WHERE data_consegna >= :data GROUP BY data_consegna ORDER BY data_consegna ASC';

$numeroConsegnati = 0;
$consegnePerGiorno = [];

try {
    $stm = $db->prepare($querySelectPlichi);
    $stm->execute();
    $plichi = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

try {
    $stm = $db->prepare($querySelectStati);
    $stm->execute();
    $stati = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_plico']) && isset($_POST['stato_plico'])) {
        try {
            //AGGIORNAMENTO STATO DEL PLICO
            $stm = $db->prepare($queryCambiaStato);
            $stm->bindValue(':id', $_POST['id_plico']);
            $stm->bindValue(':stato', $_POST['stato_plico']);
            $stm->execute();
            $stm->closeCursor();
        } catch (Exception $e) {
            logError($e);
        }

        if ($_POST['stato_plico'] == 'consegnato') {
            try {
                $stm = $db->prepare($queryUpdateRitirare);
                $stm->bindValue(':data_ritiro', date('Y-m-d')); // Data attuale
                $stm->bindValue(':ora_ritiro', date('H:i:s')); // Ora attuale
                $stm->bindValue(':id_plico', $_POST['id_plico']);
                $stm->execute();
                $stm->closeCursor();

                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP(); //protocollo mail
                    $mail->Host = 'smtp.gmail.com'; //mail SMTP server
                    $mail->SMTPAuth = true; //autorizzazione
                    $mail->Username = 'alessandro.mizzon@iisviolamarchesini.edu.it';
                    $mail->Password = '...';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //ENCRYPTION_STARTTLS = costante all'interno della classe PHPMailer
                    $mail->Port = 587;
                    $mail->setFrom('alessandro.mizzon@iisviolamarchesini.edu.it');
                    $mail->addAddress('alessandro.mizzon@iisviolamarchesini.edu.it');
                    $mail->Subject = 'Aggiornamento pacco dal team FastRoute';
                    $mail->Body = 'Il tuo pacco è stato consegnato';
                    $mail->CharSet = 'UTF-8';
                    $mail->Encoding = 'base64';
                    $mail->send();
                } catch (Exception $e) {
                    logError($e);
                }
            } catch (Exception $e) {
                logError($e);
            }
        }

        if ($_POST['stato_plico'] == 'in transito') {
            try {
                $stm = $db->prepare($queryUpdateSpedire);
                $stm->bindValue(':data_spedizione', date('Y-m-d')); // Data attuale
                $stm->bindValue(':ora_spedizione', date('H:i:s')); // Ora attuale
                $stm->bindValue(':id_plico', $_POST['id_plico']);
                $stm->execute();
                $stm->closeCursor();
            } catch (Exception $e) {
                logError($e);
            }
        }

        header('Location: ./info_plichi.php');
    }

    if (isset($_POST['giorni'])) {
        $giorni = $_POST['giorni'];
        $dataLimite = date('Y-m-d', strtotime("-$giorni days")); // Calcola la data limite

        try {
            $stm = $db->prepare($querySelectPlichiGiorni);
            $stm->bindValue(':data', $dataLimite);
            $stm->execute();

            $consegnePerGiorno = $stm->fetchAll(PDO::FETCH_ASSOC);
            $stm->closeCursor();

            // Conta il totale delle consegne
            foreach ($consegnePerGiorno as $consegna) {
                $numeroConsegnati += $consegna['numero_consegne'];
            }
        } catch (Exception $e) {
            logError($e);
        }
    }
}

echo '<div class="element"><h4>In partenza</h4><hr>';
echo '<table>';
echo '<tr><th>ID</th><th>Email Magazziniere</th><th>Email Recapito</th><th>Stato</th><th>Email Mittente</th><th>CF Destinatario</th></tr>';
foreach ($plichi as $p) {
    if ($p['stato'] == 'in partenza') {
        echo '<tr>';
        echo '<td><div class="data-box">' . $p['id'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['email_personale_magazziniere'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['email_personale_recapito'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['stato'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['email_mittente'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['CF_destinatario'] . '</div></td>';
        echo '</tr>';
    }
}
echo '</table></div>';

echo '<div class="element"><h4>In transito</h4><hr>';
echo '<table>';
echo '<tr><th>ID</th><th>Email Magazziniere</th><th>Email Recapito</th><th>Stato</th><th>Email Mittente</th><th>CF Destinatario</th></tr>';
foreach ($plichi as $p) {
    if ($p['stato'] == 'in transito') {
        echo '<tr>';
        echo '<td><div class="data-box">' . $p['id'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['email_personale_magazziniere'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['email_personale_recapito'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['stato'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['email_mittente'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['CF_destinatario'] . '</div></td>';
        echo '</tr>';
    }
}
echo '</table></div>';

echo '<div class="element"><h4>Consegnato</h4><hr>';
echo '<table>';
echo '<tr><th>ID</th><th>Email Magazziniere</th><th>Email Recapito</th><th>Stato</th><th>Email Mittente</th><th>CF Destinatario</th></tr>';
foreach ($plichi as $p) {
    if ($p['stato'] == 'consegnato') {
        echo '<tr>';
        echo '<td><div class="data-box">' . $p['id'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['email_personale_magazziniere'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['email_personale_recapito'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['stato'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['email_mittente'] . '</div></td>';
        echo '<td><div class="data-box">' . $p['CF_destinatario'] . '</div></td>';
        echo '</tr>';
    }
}
echo '</table></div><br>';
ob_end_flush();
?>

    <div class="element">
        <form method="post" action="info_plichi.php">
            <h4>Cambia stato di un plico</h4>
            <hr>

            <br>
            <label for="id_plico"><strong>ID del plico</strong></label>
            <input type='number' id='id_plico' name='id_plico' min="0" required>

            <br>
            <br>
            <?php foreach ($stati as $stato) { ?>
                <div class="form-check">
                    <input type="radio" id="<?= $stato['descrizione'] ?>" name="stato_plico"
                           value="<?= $stato['descrizione'] ?>" class="form-check-input">
                    <label for="<?= $stato['descrizione'] ?>"
                           class="form-check-label"><?= $stato['descrizione'] ?></label>
                </div>
            <?php } ?>


            <div class="submit-container">
                <input type="submit" value="Cambia stato del plico">
            </div>
        </form>
    </div>

    <div class="element">
    <form method="post" action="info_plichi.php">
        <h4>Desideri sapere quanti plichi sono stati consegnati negli utlimi giorni?</h4>
        <hr>

        <br>
        <label for="giorni"><strong>Giorni</strong></label>
        <input type='number' id='giorni' name='giorni' min="0" required>

        <div class="submit-container">
            <input type="submit" value="Visualizza">
        </div>
    </form>

<?php if (isset($_POST['giorni'])) { ?>
    <br>
    <h4>Plichi consegnati negli ultimi <?php echo $_POST['giorni']; ?> giorni</h4>
    <hr>
    <p><strong>Totale plichi consegnati:</strong> <?php echo $numeroConsegnati; ?></p>

    <?php if (!empty($consegnePerGiorno)) { ?>
        <table>
            <tr>
                <th>Data</th>
                <th>Numero di consegne</th>
            </tr>
            <?php foreach ($consegnePerGiorno as $consegna) { ?>
                <tr>
                    <td><?php echo $consegna['data_consegna']; ?></td>
                    <td><?php echo $consegna['numero_consegne']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Nessuna consegna registrata in questo intervallo di tempo.</p>
    <?php } ?>
<?php } ?>


<?php require '../references/footer.php'; ?>
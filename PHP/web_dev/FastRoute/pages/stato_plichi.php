<?php
$title = 'nuovo plico';
require '../references/navbar.php';

$config = $_SESSION['config']; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$querySelectPlichi = 'SELECT * FROM db_FastRoute.plichi';
$querySelectStati = 'SELECT * FROM db_FastRoute.stati';

$queryCambiaStato = 'UPDATE db_FastRoute.plichi SET stato = :stato WHERE id = :id';

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
    if(isset($_POST['id_plico']) && isset($_POST['stato_plico'])) {
        try {
            $stm = $db->prepare($queryCambiaStato);
            $stm->bindValue(':id', $_POST['id_plico']);
            $stm->bindValue(':stato', $_POST['stato_plico']);
            $stm->execute();
            $stm->closeCursor();

            header('Location: ./stato_plichi.php');
        } catch (Exception $e) {
            logError($e);
        }
    }
}

echo '<br><h4>In partenza</h4><hr>';
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
echo '</table>';

echo '<br><br><h4>In transito</h4><hr>';
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
echo '</table>';

echo '<br><br><h4>Consegnato</h4><hr>';
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
echo '</table>';
?>

<form method="post" action="stato_plichi.php">
    <br>
    <br>
    <h4>Cambia stato plico</h4><hr>

    <label for="id_plico">ID plico</label>
    <input type='text' id='id_plico' name='id_plico' required>

    <br>
    <br>
    <h4><label for="stato_plico">Stato plico</label></h4><hr>
    <?php foreach ($stati as $stato) {
        echo '<input type="radio" id="' . $stato['descrizione'] . '"name="stato_plico" value="' . $stato['descrizione'] . '">
              <label for="' . $stato['descrizione'] . '">' . $stato['descrizione'] . '</label><br>'; //seconda label che fa riferimento alla prima per consentire una maggiore usabilità
    } ?>

    <br><br>
    <input type="submit" value="Cambia stato">

</form>

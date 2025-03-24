<?php
ob_start();
$title = 'dashboard';
require '../references/navbar.php';

$config = require '../connectionToDB/databaseConfig.php';; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$querySelectDashboard = 'SELECT * FROM db_FastRoute.dashboard';

try {
    $stm = $db->prepare($querySelectDashboard);
    $stm->execute();
    $content = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

//data e ora di spedizione e ritiro risultano spazio vuoto finchè non avviene la spedizione o ritiro
// i campi corrispondenti sono poi aggiornati ma di default sono NULL

echo '<div class="element"><h4>Dashboard</h4><hr>';
echo '<table>';
echo '<tr><th>ID plico</th><th>stato</th><th>email mittente</th><th>CF destinatario</th><th>email magazziniere</th><th>data consegna</th><th>ora consegna</th><th>email corriere</th><th>data spedizione</th><th>ora spedizione</th><th>email recapito</th><th>data ritiro</th><th>ora ritiro</th></tr>';
foreach ($content as $c) {
    echo '<tr>';
    echo '<td><div class="data-box">' . $c['id'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['stato'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['email_mittente'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['CF_destinatario'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['email_magazziniere'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['data_consegna'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['ora_consegna'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['email_corriere'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['data_spedizione'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['ora_spedizione'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['email_recapito'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['data_ritiro'] . '</div></td>';
    echo '<td><div class="data-box">' . $c['ora_ritiro'] . '</div></td>';
    echo '</tr>';
}
echo '</table></div><br>';

ob_end_flush();
?>


<?php require '../references/footer.php'; ?>


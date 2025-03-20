<?php
$title = 'nuovo plico';
require '../references/navbar.php';

$config = $_SESSION['config']; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$querySelectPlichi = 'SELECT * FROM db_FastRoute.plichi';

try {
    $stm = $db->prepare($querySelectPlichi);
    $stm->execute();
    $plichi = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

echo '<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 15px;
        text-align: center;
        border: 1px solid #ccc;
    }
    td {
        background-color: #f9f9f9;
    }
    th {
        background-color: #86f1ee;
    }
    .data-box {
        padding: 10px;
        border-radius: 5px;
        margin: 5px;
    }
</style>';

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

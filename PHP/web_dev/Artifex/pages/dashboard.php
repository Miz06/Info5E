<?php
ob_start();
$title = 'Dashboard';

require '../references/navbar.php';
require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectGuide = 'SELECT * FROM guide';
$querySelectEventi = 'SELECT * FROM eventi';
$querySelectVisite = 'SELECT * FROM visite';

try {
    $stm = $db->prepare($querySelectGuide);
    $stm->execute();
    $guide = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

try {
    $stm = $db->prepare($querySelectVisite);
    $stm->execute();
    $visite = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

try {
    $stm = $db->prepare($querySelectEventi);
    $stm->execute();
    $eventi = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

echo '<div class="container">';
echo '<table><thead>';
echo '<h3><strong>Eventi</strong></h3><hr>';
echo '<tr><th>Id evento</th><th>Data</th><th>Ora</th><th>Prezzo</th><th>Minimo partecipanti</th><th>Massimo partecipanti</th><th>Titolo visita</th><th>Id guida</th></tr>';
echo '</thead><tbody>';
foreach ($eventi as $e) {
    echo '<tr>';
    echo '<td>' . $e['id'] . '</td>';
    echo '<td>' . $e['data'] . '</td>';
    echo '<td>' . $e['ora_inizio'] . '</td>';
    echo '<td>' . $e['prezzo'] . '</td>';
    echo '<td>' . $e['max_partecipanti'] . '</td>';
    echo '<td>' . $e['min_partecipanti'] . '</td>';
    echo '<td>' . $e['titolo_visita'] . '</td>';
    echo '<td>' . $e['id_guida'] . '</td>';
    echo '</tr>';
}
echo '</tbody></table>';
echo '</div>';

echo '<div class="container">';
echo '<table><thead>';
echo '<h3><strong>Guide</strong></h3><hr>';
echo '<tr><th>Id guida</th><th>Titolo/i di studio</th><th>Nome</th><th>Cognome</th><th>Data di nascita</th><th>Luogo di nascita</th></tr>';
echo '</thead><tbody>';
foreach ($guide as $g) {
    echo '<tr>';
    echo '<td>' . $g['id'] . '</td>';
    echo '<td></td>';
    echo '<td>' . $g['cognome'] . '</td>';
    echo '<td>' . $g['nome'] . '</td>';
    echo '<td>' . $g['data_nascita'] . '</td>';
    echo '<td>' . $g['luogo_nascita'] . '</td>';
    echo '</tr>';
}
echo '</tbody></table>';
echo '</div>';

echo '<div class="container">';
echo '<table><thead>';
echo '<h3><strong>Visite</strong></h3><hr>';
echo '<tr><th>Titolo</th><th>Durata media</th><th>luogo</th></tr>';
echo '</thead><tbody>';
foreach ($visite as $v) {
    echo '<tr>';
    echo '<td>' . $v['titolo'] . '</td>';
    echo '<td>' . $v['durata_media'] . '</td>';
    echo '<td>' . $v['luogo'] . '</td>';
    echo '</tr>';
}
echo '</tbody></table>';
echo '</div>';
?>


<?php require '../references/footer.php'; ?>

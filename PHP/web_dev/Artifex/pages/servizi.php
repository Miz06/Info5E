<?php
ob_start();
$title = 'servizi';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectEventi = 'SELECT * from db_artifex.eventi join db_artifex.visite v on v.titolo = db_artifex.eventi.titolo_visita join db_artifex.guide g on g.id = eventi.id_guida;
';

try{
    $stm=$db->prepare($querySelectEventi);
    $stm->execute();

    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
}catch(Exception $e){
    logError($e);
}

echo '<div class="container">';
echo '<table><thead>';
echo '<tr><th>Data</th><th>Ora</th><th>Prezzo</th><th>Min p.</th><th>Max p.</th><th>Titolo visita</th><th>Id guida</th></tr>';
echo '</thead><tbody>';
foreach($data as $d){
    echo '<tr>';
    echo '<td>' . $d['data'] . '</td>';
    echo '<td>' . $d['ora_inizio'] . '</td>';
    echo '<td>' . $d['prezzo'] . '</td>';
    echo '<td>' . $d['min_partecipanti'] . '</td>';
    echo '<td>' . $d['max_partecipanti'] . '</td>';
    echo '<td>' . $d['titolo_visita'] . '</td>';
    echo '<td>' . $d['id_guida'] . '</td>';
    echo '</tr>';
}
echo '</tbody></table>';

echo '</div>';
?>

<?php require '../references/footer.php' ?>

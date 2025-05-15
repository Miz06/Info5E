<?php
ob_start();
$title = 'Carrello';

require '../references/navbar.php';
require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectCarrello = 'SELECT * 
FROM db_artifex.salvare s
JOIN db_artifex.eventi e ON e.id = s.id_evento 
JOIN db_artifex.guide g ON e.id_guida = g.id 
WHERE s.email = :email';

try {
    $stm = $db->prepare($querySelectCarrello);
    $stm->bindValue(':email', $_SESSION['email']);
    $stm->execute();
    $salvati = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}


echo '<div class="container">';
echo '<table><thead>';
echo '<h3><strong>Carrello</strong></h3><hr>';
echo '<tr><th>Data</th><th>Ora</th><th>Prezzo</th><th>Titolo visita</th><th>Nome guida</th><th>Cognome guida</th></tr>';
echo '</thead><tbody>';
foreach($salvati as $s){
    echo '<tr>';
    echo '<td>' . $s['data'] . '</td>';
    echo '<td>' . $s['ora_inizio'] . '</td>';
    echo '<td>' . $s['prezzo'] . '</td>';
    echo '<td>' . $s['titolo_visita'] . '</td>';
    echo '<td>' . $s['nome'] . '</td>';
    echo '<td>' . $s['cognome'] . '</td>';
    echo '</tr>';
}
echo '</tbody></table>';

echo '</div>';
?>


<?php require '../references/footer.php'; ?>

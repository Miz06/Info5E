<?php
ob_start();
$title = 'Eventi';

require '../references/navbar.php';
require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectEventi = 'SELECT * FROM db_artifex.eventi 
                      JOIN db_artifex.visite v ON v.titolo = db_artifex.eventi.titolo_visita 
                      JOIN db_artifex.guide g ON g.id = eventi.id_guida order by db_artifex.eventi.titolo_visita';

$querySelectVisite = 'SELECT * FROM db_artifex.visite';

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
echo '<h1><strong>Eventi disponibili</strong></h1><hr>';
foreach ($visite as $v) {
    echo '<div class="container" style="background-color:lightblue;">';
    echo '<h3><strong>' . $v['titolo'] . '</strong></h3><hr>';
    foreach ($eventi as $e) {
        if ($v['titolo'] == $e['titolo_visita']) {
            echo '<div class="container">';
            echo '<h5><strong>Data e ora:</strong> ' . $e['data'] . ' - ' . $e['ora_inizio'] . '</h5>';
            echo '<h5><strong>Guida:</strong> ' . $e['nome'] . ' ' . $e['cognome'] . '</h5>';
            echo '<h5><strong>Prezzo:</strong> €' . $e['prezzo'] . '</h5>';

            echo '<div class="d-flex justify-content-center gap-3 my-3">'; // FLEXBOX CENTRATO
            echo '<a href="./evento.php" class="btn btn-primary">Prenota</a>';
            echo '<a href="./evento.php" class="btn btn-secondary">Aggiungi al carrello</a>';
            echo '</div>';
            echo '</div>';
        }
    }

    echo '</div>';
}
echo '</div>';
?>


<?php require '../references/footer.php'; ?>

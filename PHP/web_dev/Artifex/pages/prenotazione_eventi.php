<?php
ob_start();
$title = 'Prenotazione';

require '../references/navbar.php';
require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectEventi = 'SELECT * FROM db_artifex.eventi 
                      JOIN db_artifex.visite v ON v.titolo = db_artifex.eventi.titolo_visita 
                      JOIN db_artifex.guide g ON g.id = eventi.id_guida;';

$queryInsertIntoPrenotare = 'INSERT INTO db_artifex.prenotare (data, ora_inizio, titolo_visita, email) VALUES (:data, :ora_inizio, :titolo_visita, :email)';

try {
    $stm = $db->prepare($querySelectEventi);
    $stm->execute();
    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

if($eventi){
    try {
        $stm = $db->prepare($queryInsertIntoPrenotare);
        $stm->bindValue(':data', $data[0]['data']);
        $stm->bindValue(':ora_inizio', $data[0]['ora_inizio']);
        $stm->bindValue(':titolo', $data[0]['titolo']);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
    }
}
?>

<div class="container">
    <form action="prenotazione_eventi.php" method="post">
        <label for="eventi">Seleziona eventi</label><br>

        <?php
        foreach ($data as $d) {
            $checkboxValue = htmlspecialchars($d['titolo_visita'] . ' [' . $d['data'] . ' - ' . $d['ora_inizio'] . '] ');
            echo '<label for="' . $checkboxValue . '">' . $checkboxValue . '</label><br>';
            echo '<input type="checkbox" name="eventi[]" value="' . $checkboxValue . '" id="' . $checkboxValue . '">';
        }
        ?>

        <input type="submit" value="Prenota">
    </form>
</div>

<?php require '../references/footer.php'; ?>

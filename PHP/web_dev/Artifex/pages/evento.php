<?php
ob_start();
$title = 'Prenotazione';

require '../references/navbar.php';
require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectEventi = 'SELECT * FROM db_artifex.eventi e WHERE e.id = :id 
                      JOIN db_artifex.visite v ON v.titolo = db_artifex.eventi.titolo_visita 
                      JOIN db_artifex.guide g ON g.id = eventi.id_guida;';

$queryInsertIntoPrenotare = 'INSERT INTO db_artifex.prenotare (id_evento, email) VALUES (:id_evento, :email)';

try {
    $stm = $db->prepare($querySelectEventi);
    $stm->execute();
    $evento = $stm->fetch(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

try {
    $stm = $db->prepare($queryInsertIntoPrenotare);
    $stm->bindValue(':id_evento', $id_evento);
    $stm->bindValue(':email', $_SESSION['email']);
    $stm->execute();
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}
?>

<?php if($evento){?>
<div class="container">
    <h4>Titolo visita: <?php echo $evento['titolo_visita']?></h4>
    <h4>Guida: <?php echo $evento['nome'] . $evento['cognome']?></h4>
    <h4>Data e ora: <?php echo $evento['data'] . $evento['ora']?></h4>
    <h4>Prezzo: <?php echo $evento['prezzo']?></h4>
</div>

<?php }?>
<?php require '../references/footer.php'; ?>

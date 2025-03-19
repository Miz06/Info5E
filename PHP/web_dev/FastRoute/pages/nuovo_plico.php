<?php
$title = 'aggiorna password';
require '../references/navbar.php';

$config = $_SESSION['config']; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$queryInsertPlico = 'INSERT INTO db_FastRotue.consegnare (data_consegna, ora_consegna, telefono_mittente, id_plico) values (:data_consegna, :ora_consegna, :telefono_mittente, :id_plico)';

try {
    $stm = $db->prepare($queryInsertPlico);

    $stm->bindValue(':data_consegna', $_POST['data_consegna']);
    $stm->bindValue(':ora_consegna', $_POST['ora_consegna']);
    $stm->bindValue(':telefono_mittente', $_POST['telefono_mittente']);
    $stm->bindValue(':id_plico', $_POST['id_plico']);

    $stm->execute();
    $stm->CloseCursor();
} catch (Exception $e) {
    logError($e);
}

?>

<form method="post" action="nuovo_plico.php">
    <!-- -->
</form>

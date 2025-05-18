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

$queryDeleteFromCarrello = 'DELETE FROM db_artifex.salvare WHERE id_evento = :id_evento AND email = :email';
$queryInsertIntoPrenotare = 'INSERT INTO db_artifex.prenotare (id_evento, email) VALUES(:id_evento, :email)';

try {
    $stm = $db->prepare($querySelectCarrello);
    $stm->bindValue(':email', $_SESSION['email']);
    $stm->execute();
    $salvati = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

if (isset($_POST['eventi_selezionati'])) {
    foreach ($_POST['eventi_selezionati'] as $evento) {
        try {
            $stm = $db->prepare($queryDeleteFromCarrello);
            $stm->bindValue(':id_evento', $evento);
            $stm->bindValue(':email', $_SESSION['email']);
            $stm->execute();
            $stm->closeCursor();

            $stm= $db->prepare($queryInsertIntoPrenotare);
            $stm->bindValue(':id_evento', $evento);
            $stm->bindValue(':email', $_SESSION['email']);
            $stm->execute();
            $stm->closeCursor();
        }catch (Exception $e) {
            logError($e);
        }
    }

    header("Location: ./carrello.php");
    exit;
}

echo '<div class="container">';
if($salvati){
    echo '<form action="carrello.php" method="post">';
    echo '<h3><strong>Eventi nel tuo carrello</strong></h3><hr>';
    echo '<table><thead><tr>';
    echo '<th>Prenota</th><th>Data</th><th>Ora</th><th>Prezzo</th><th>Titolo visita</th><th>Nome guida</th><th>Cognome guida</th>';
    echo '</tr></thead><tbody>';

    foreach ($salvati as $s) {
        echo '<tr>';
        echo '<td><input type="checkbox" name="eventi_selezionati[]" value="' . $s['id_evento'] . '"></td>';
        echo '<td>' . $s['data'] . '</td>';
        echo '<td>' . $s['ora_inizio'] . '</td>';
        echo '<td>' . $s['prezzo'] . ' €</td>';
        echo '<td>' . $s['titolo_visita'] . '</td>';
        echo '<td>' . $s['nome'] . '</td>';
        echo '<td>' . $s['cognome'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table><br>';
    echo '<div class="submit-container"><input type="submit" value="Prenota gli eventi selezionati"></div>';
    echo '</form>';
}else {
    echo '<h6><strong>Il tuo carrello è vuoto</strong></h6><hr>';
}
echo '</div>';

?>


<?php require '../references/footer.php'; ?>

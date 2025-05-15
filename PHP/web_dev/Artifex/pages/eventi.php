<?php
ob_start();
$title = 'Prenota';

require '../references/navbar.php';
require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectEventi = 'SELECT * FROM db_artifex.eventi 
                      JOIN db_artifex.visite v ON v.titolo = db_artifex.eventi.titolo_visita 
                      JOIN db_artifex.guide g ON g.id = eventi.id_guida order by db_artifex.eventi.titolo_visita';

$querySelectVisite = 'SELECT * FROM db_artifex.visite';
$queryInsertIntoPrenotare = 'INSERT INTO db_artifex.prenotare (id_evento, email) VALUES (:id_evento, :email)';
$queryInsertIntoSalvare = 'INSERT INTO db_artifex.salvare (id_evento, email) VALUES (:id_evento, :email)';

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id_prenota"])) {
        try {
            $stm = $db->prepare($queryInsertIntoPrenotare);
            $stm->bindParam(':id_evento', $_POST["id_prenota"]);
            $stm->bindParam(':email', $_SESSION["email"]);
            $stm->execute();
            $stm->closeCursor();
            header("location: ./account.php");
        } catch (Exception $e) {
            logError($e);
        }
    } else if (isset($_POST["id_carrello"])) {
        try {
            $stm = $db->prepare($queryInsertIntoSalvare);
            $stm->bindParam(':id_evento', $_POST["id_carrello"]);
            $stm->bindParam(':email', $_SESSION["email"]);
            $stm->execute();
            $stm->closeCursor();
            header("location: ./carrello.php");
        } catch (Exception $e) {
            logError($e);
        }
    }
}

foreach ($visite as $v) {
    echo '<br><div class="container" style="background-color:lightblue;">';
    echo '<h3><strong>' . $v['titolo'] . '</strong></h3><hr>';
    foreach ($eventi as $e) {
        if ($v['titolo'] == $e['titolo_visita']) {
            echo '<div class="container" style="background-color:whitesmoke;"> ';
            echo '<h5><strong>Data e ora:</strong> ' . $e['data'] . ' - ' . $e['ora_inizio'] . '</h5>';
            echo '<h5><strong>Guida:</strong> ' . $e['nome'] . ' ' . $e['cognome'] . '</h5>';
            echo '<h5><strong>Prezzo:</strong> €' . $e['prezzo'] . '</h5>';

            echo '<div class="button-wrapper">';

            echo '<form action="eventi.php" method="post">';
            echo '<input type="hidden" name="id_carrello" value="' . $e['id'] . '">';
            echo '<button type="submit" class="btn-carrello">Aggiungi al carrello</button>';
            echo '</form>';

            echo '<form action="eventi.php" method="post">';
            echo '<input type="hidden" name="id_prenota" value="' . $e['id'] . '">';
            echo '<button type="submit" class="btn-prenota">Prenota</button>';
            echo '</form>';

            echo '</div>';



            echo '</div>';
        }
    }

    echo '</div>';
}
?>


<?php require '../references/footer.php'; ?>

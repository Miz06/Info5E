<?php
ob_start();
$title = "Account";

require '../references/navbar.php';

$config = require '../references/connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryUpdatePrice = 'UPDATE prodotti SET costo = :costo WHERE codice = :codice';
$queryRemoveProdotto = 'DELETE FROM prodotti WHERE codice = :codice';
$queryInsertProdotto = 'INSERT INTO prodotti (descrizione, costo, quantita) values (:descrizione, :costo, :quantita)';

if (isset($_POST['inserisci_descrizione']) && isset($_POST['inserisci_costo']) && isset($_POST['inserisci_quantita'])) {
    try {
        $stm = $db->prepare($queryInsertProdotto);
        $stm->bindValue(':descrizione', $_POST['inserisci_descrizione']);
        $stm->bindValue(':costo', $_POST['inserisci_costo']);
        $stm->bindValue(':quantita', $_POST['inserisci_quantita']);
        $stm->execute();
        $stm->closeCursor();
        header("Location: ./prodotti.php");
    } catch (Exception $e) {
        logError($e);
    }
}

if (isset($_POST['aggiorna_costo']) && isset($_POST['aggiorna_codice'])) {
    try {
        $stm = $db->prepare($queryUpdatePrice);
        $stm->bindValue(':costo', $_POST['aggiorna_costo']);
        $stm->bindValue(':codice', $_POST['aggiorna_codice']);
        $stm->execute();
        $stm->closeCursor();
        header("Location: ./prodotti.php");
    } catch (Exception $e) {
        logError($e);
    }
}

if (isset($_POST['rimuovi_codice'])) {
    try {
        $stm = $db->prepare($queryRemoveProdotto);
        $stm->bindValue(':codice', $_POST['rimuovi_codice']);
        $stm->execute();
        $stm->closeCursor();
        header("Location: ./prodotti.php");
    } catch (Exception $e) {
        logError($e);
    }
}

?>

<div class="element">
    <h4>Inserisci un nuovo prodotto</h4><br>
    <form action="gestione_prodotti.php" method="post">
        <label for="inserisci_descrizione"><strong>Descrizione</strong></label>
        <input type="text" id="inserisci_descrizione" name="inserisci_descrizione" required>

        <label for="inserisci_costo"><strong>Costo</strong></label>
        <input type="number" id="inserisci_costo" name="inserisci_costo" step="0.01" required>

        <label for="inserisci_quantita"><strong>Quantità</strong></label>
        <input type="number" id="inserisci_quantita" name="inserisci_quantita" required>

        <div class="submit-container">
            <input type="submit" value="Inserisci">
        </div>
    </form>
</div>

<div class="element">
    <h4>Aggiorna costo di un prodotto</h4><br>
    <form action="gestione_prodotti.php" method="post">
        <label for="aggiorna_codice"><strong>Codice</strong></label>
        <input type="number" id="aggiorna_codice" name="aggiorna_codice" required>

        <label for="aggiorna_costo"><strong>Nuovo costo</strong></label>
        <input type="number" id="aggiorna_costo" name="aggiorna_costo" step="0.01" required>

        <div class="submit-container">
            <input type="submit" value="Aggiorna">
        </div>
    </form>
</div>

<div class="element">
    <h4>Rimuovi prodotto</h4><br>
    <form action="gestione_prodotti.php" method="post">
        <label for="rimuovi_codice"><strong>Codice</strong></label>
        <input type="number" id="rimuovi_codice" name="rimuovi_codice" required>

        <div class="submit-container">
            <input type="submit" value="Rimuovi">
        </div>
    </form>
</div>
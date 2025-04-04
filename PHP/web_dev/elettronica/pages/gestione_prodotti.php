<?php
ob_start();
$title = "Account";

require '../references/navbar.php';

$config = require '../references/connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryUpdatePrice = 'UPDATE prodotti SET costo = :costo WHERE codice = :codice';

if(isset($_POST['costo']) && isset($_POST['codice'])){
    try{
        $stm = $db -> prepare($queryUpdatePrice);
        $stm -> bindValue(':costo', $_POST['costo']);
        $stm -> bindValue(':codice', $_POST['codice']);
        $stm->execute();
        $stm->closeCursor();
        header("Location: ./prodotti.php");
    }catch(Exception $e){
        logError($e);
    }
}

?>

<div class="element">
    <h4>Aggiorna costo di un prodotto</h4><br>
    <form action="gestione_prodotti.php" method="post">
        <label for="codice"><strong>Codice prodotto</strong></label>
        <input type="number" id="codice" name="codice" required>

        <label for="costo"><strong>Nuovo costo</strong></label>
        <input type="number" id="costo" name="costo" required>

        <div class="submit-container">
            <input type="submit" value="Aggiorna prezzo">
        </div>
        </form>
</div>
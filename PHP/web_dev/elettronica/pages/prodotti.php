<?php
ob_start();
$title = "Prodotti";

require '../references/navbar.php';

$config = require '../references/connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectProdotti = "SELECT * FROM prodotti";

try{
    $stm=$db->prepare($querySelectProdotti);
    $stm->execute();
    $prodotti = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
}catch(Exception $e){
    logError($e);
}

echo '<div class="element"><h4 style="text-align: center">Prodotti disponibili</h4>';
echo '<table>';
echo '<tr><th>Codice</th><th>Descrizione</th><th>Costo</th><th>Quantità</th><th>Data di produzione</th></tr><br>';
foreach($prodotti as $prodotto){
    echo '<tr>';
    echo '<td>'.$prodotto['codice'].'</td>';
    echo '<td>'.$prodotto['descrizione'].'</td>';
    echo '<td>'.$prodotto['costo'].'</td>';
    echo '<td>'.$prodotto['quantita'].'</td>';
    echo '<td>'.$prodotto['data_produzione'].'</td>';
    echo '</tr>';
}
echo '</table></div>';
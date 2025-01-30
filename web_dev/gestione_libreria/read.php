<?php
$title = 'Read';
require './connection.php';
require './navbar.php';
require './footer.php';

$query = 'select * from table_libreria';
try {
    $stm = $db->prepare($query);
    $stm->execute();
    while ($libro = $stm->fetch()) {
        echo "Titolo: " . $libro->titolo . "<br>";
        echo "Genere: " . $libro->genere . "<br>";
        echo "Autore: " . $libro->autore . "<br>";
        echo "Prezzo: " . $libro->prezzo . "<br>";
        echo "Anno pubblicazione: " . $libro->anno_pubblicazione . "<hr>";
    }
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

function logError(Exception $e)
{
    error_log($e->getMessage(), 3, 'log/database_log');
    echo 'A DB error occurred, Try again';
}
?>


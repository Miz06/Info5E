<?php

$title = 'registra cliente';
require '../references/navbar.php';

$config = $_SESSION['config']; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$queryInsertCliente = "INSERT INTO db_FastRoute.clienti (nome, cognome, indirizzo, telefono, email, email_personale) values (:nome, :cognome, :indirizzo, :telefono, :email, :email_personale)";

try{
    $stm=$db->prepare($queryInsertCliente);
    $stm->bindValue(':nome', $_POST['nome']);
    $stm->bindValue(':cognome', $_POST['cognome']);
    $stm->bindValue(':indirizzo', $_POST['indirizzo']);
    $stm->bindValue(':telefono', $_POST['telefono']);
    $stm->bindValue(':email', $_POST['email']);
    $stm->bindValue(':email_personale', $_SESSION['email']);

    $stm->execute();
    $stm->closeCursor();
}catch (Exception $e){
    logError($e);
}
?>

<form>


</form>

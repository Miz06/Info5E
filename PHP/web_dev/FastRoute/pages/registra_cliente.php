<?php

$title = 'registra cliente';
require '../references/navbar.php';

$config = $_SESSION['config']; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$queryInsertCliente = "INSERT INTO db_FastRoute.clienti (nome, cognome, indirizzo, telefono, email, email_personale) values (:nome, :cognome, :indirizzo, :telefono, :email, :email_personale)";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['indirizzo']) && isset($_POST['telefono']) && isset($_POST['email']) && isset($_SESSION['email'])) {
    try {
        $stm = $db->prepare($queryInsertCliente);

        $stm->bindValue(':nome', $_POST['nome']);
        $stm->bindValue(':cognome', $_POST['cognome']);
        $stm->bindValue(':indirizzo', $_POST['indirizzo']);
        $stm->bindValue(':telefono', $_POST['telefono']);
        $stm->bindValue(':email', $_POST['email']);
        $stm->bindValue(':email_personale', $_SESSION['email']);

        $stm->execute();
        $stm->closeCursor();

        header('Location: ../info.php');
    } catch (Exception $e) {
        logError($e);
    }
}

?>


<form method="post" action="registra_cliente.php">
    <br>
    <label for="nome"><strong>Nome</strong></label>
    <input type="text" id="nome" name="nome" required>
    <hr>

    <br>
    <label for="cognome"><strong>Cognome</strong></label>
    <input type="text" id="cognome" name="cognome" required>
    <hr>

    <br>
    <label for="email"><strong>Email</strong></label>
    <input type="text" id="email" name="email" required>
    <hr>

    <br>
    <label for="telefono"><strong>Telefono</strong></label>
    <input type="text" id="telefono" name="telefono" required>
    <hr>

    <br>
    <label for="indirizzo"><strong>Indirizzo</strong></label>
    <input type="text" id="indirizzo" name="indirizzo" required>
    <hr>

    <input type="submit" value="Registra">
</form>

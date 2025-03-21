<?php
$title = 'aggiorna password';
require '../references/navbar.php';

$config = $_SESSION['config']; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$queryUpdatePassword = 'UPDATE db_FastRoute.personale SET password = :password WHERE email = :email';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['email'])) {
    if ($_POST['nuova_password'] == $_POST['conferma_nuova_password']) {
        $nuova_password = password_hash($_POST['nuova_password'], PASSWORD_DEFAULT);

        try {
            $stm = $db->prepare($queryUpdatePassword);
            $stm->bindValue(':password', $nuova_password);
            $stm->bindValue(':email', $_SESSION['email']);
            $stm->execute();
            $stm->closeCursor();

            header('Location: ./account.php');
        } catch (Exception $e) {
            logError($e);
        }
    } else {
        echo 'Password differenti';
    }
}
?>

<form method="post" action="aggiorna_password.php">
    <br>
    <br>
    <h4>Cambia password</h4><hr>
    <label for="nuova_password"><strong>Nuova password</strong></label>
    <input type="password" name="nuova_password" id="nuova_password" required>

    <br>
    <label for="conferma_nuova_password"><strong>Conferma nuova password</strong></label>
    <input type="password" name="conferma_nuova_password" id="conferma_nuova_password" required>

    <br>
    <br>
    <input type="submit" value="Submit">


</form>

</body>
</html>
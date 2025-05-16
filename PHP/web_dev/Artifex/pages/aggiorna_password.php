<?php
ob_start();
$title = "aggiorna password";

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryUpdatePassword = 'UPDATE turisti SET password = :password WHERE email =:email';
$querySelectTurista = 'SELECT * FROM turisti WHERE email =:email';

try {
    $stm = $db->prepare($querySelectTurista);
    $stm->bindValue(':email', $_SESSION['email']);
    $stm->execute();

    $turista = $stm->fetch(PDO::FETCH_ASSOC);
    $stm->closeCursor();

    if (isset($_POST['old_password']) && isset($_POST['new_password'])) {
        if ($turista && password_verify($_POST['old_password'], $turista['password']) && $_POST['new_password'] == $_POST['confirm_new_password']) {
            $stm = $db->prepare($queryUpdatePassword);
            $stm->bindValue(':password', password_hash($_POST['new_password'], PASSWORD_DEFAULT));
            $stm->bindValue(':email', $_SESSION['email']);
            $stm->execute();
            $stm->closeCursor();
            header('Location: ./account.php');
            exit;
        }
    }
} catch (Exception $e) {
    logError($e);
}
ob_end_flush();
?>

<form action="aggiorna_password.php" method="post">
    <div class="container">
        <h4>Aggiorna la tua password</h4>
        <hr style="margin-bottom: 3%">
        <label for="old_password"><strong>Vecchia password</strong></label>
        <input type="password" id="old_password" name="old_password" required>
        <hr>
        <br>

        <label for="new_password"><strong>Nuova password</strong></label>
        <input type="password" id="new_password" name="new_password" required>
        <hr>
        <br>

        <label for="confirm_new_password"><strong>Conferma nuova password</strong></label>
        <input type="password" id="confirm_new_password" name="confirm_new_password" required>
        <hr>
        <br>

        <div class="submit-container">
            <input type="submit" value="Aggiorna password">
        </div>
    </div>
</form>

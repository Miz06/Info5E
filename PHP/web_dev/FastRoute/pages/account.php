<?php
$title = 'account';
require '../references/navbar.php';

$config = $_SESSION['config']; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$queryUpdatePassword = 'UPDATE db_FastRoute.personale SET password = :password WHERE email = :email';
$querySelectUserData = 'SELECT * FROM db_FastRoute.personale WHERE email = :email';

if (isset($_SESSION['email']) && $_SESSION['email'] != 'Ospite') {
    try {
        $stm = $db->prepare($querySelectUserData);
        $stm->bindValue(':email', $_SESSION['email']);
        $stm->execute();

        $userData = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password_attuale'])) {
        if (password_verify($_POST['password_attuale'], $userData['password'])) {
            header('location: ../pages/aggiorna_password.php');
        } else
            echo 'Password incorretta';
    }
}
?>

<?php if (isset($_SESSION['email']) && $_SESSION['email'] != 'Ospite') { ?>
    <br>
    <br>
    <h4>Info account</h4><hr>
    <p><strong>Nome: </strong> <?= $userData['nome'] ?></p>
    <p><strong>Email: </strong> <?= $userData['email'] ?></p>
    <p><strong>Città: </strong> <?= $userData['citta'] ?></p>
    <p><strong>Via: </strong> <?= $userData['via'] ?></p>

    <br>
    <br>
    <h4>Desideri cambiare password?</h4><hr>
    <p>[È prima necessario inserire la password in uso]</p>
    <form method="post" action="account.php">
        <label for="password_attuale"><strong>Password attuale</strong></label>
        <input type="password" name="password_attuale" id="password_attuale" required>

        <input type="submit" value="Submit">
    </form>

    <br>
    <br>
    <h4>Desideri cambiare le preferenze?</h4><hr>
    <a href="./preferenze.php" class="btn btn-primary">Vai alle impostazioni</a>

    <br>
    <br>
    <br>
    <h4>Esci dall'account</h4><hr>
    <a href="./logout.php" class="btn btn-primary">Log out</a>

<?php } else { ?>
    <p><strong>Nome: </strong>Ospite</p>
    <p>[L'account ospite ha a sua disposizione i servizi di base: sono disponibii maggiori funzionalità solamente previo login.]</p>
<?php } ?>

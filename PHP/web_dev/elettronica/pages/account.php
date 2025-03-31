<?php
$title = "Account";

require '../references/navbar.php';

$config = require '../references/connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryDatauser = "SELECT * FROM users WHERE email = :email";

if (isset($_SESSION['user'])) {
    $stm = $db->prepare($queryDatauser);
    $stm->bindValue(':email', $_SESSION['user']);
    $stm->execute();

    $userData = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} else if (isset($_SESSION['admin'])) {
    $stm = $db->prepare($queryDatauser);
    $stm->bindValue(':email', $_SESSION['admin']);
    $stm->execute();

    $userAdmin = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
}

?>

<?php if (isset($userData) || isset($userAdmin)) { ?>
    <?php if (isset($userData)) { ?>
        <div class="element">
            <h4>Info user</h4>
            <hr>
            <p><strong>Nome: </strong> <?= $userData['nome'] ?></p>
            <p><strong>Email: </strong> <?= $userData['email'] ?></p>
        </div>
    <?php } else if (isset($userAdmin)) { ?>
        <div class="element">
            <h4>Info admin</h4>
            <hr>
            <p><strong>Nome: </strong> <?= $userAdmin['nome'] ?></p>
            <p><strong>Email: </strong> <?= $userAdmin['email'] ?></p>
        </div>
    <?php } ?>
    <div class="element">

        <h4>Desideri cambiare password?</h4>
        <hr>
        <p>[È prima necessario inserire la password in uso]</p>
        <form method="post" action="account.php">
            <label for="password_attuale"><strong>Password attuale</strong></label>
            <input type="password" name="password_attuale" id="password_attuale" required>

            <div class="submit-container">
                <input type="submit" value="Vai alla pagina di cambiamento password">
            </div>
        </form>
    </div>

    <div class="element">

        <h4>Esci dall'account</h4>
        <hr>
        <a href="../references/logout.php" class="btn-primary log-out">Log out</a>
    </div>

<?php } else { ?>
    <div class="element">
        <p><strong>Nome: </strong>Ospite</p>
        <p>[Dall'ccount ospite è possibile solamente visualizzare i prodotti in espsosizione]</p>
    </div>
<?php } ?>

<?php require '../references/footer.php' ?>

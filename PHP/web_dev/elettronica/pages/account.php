<?php
$title = "Account";

require '../references/navbar.php';

$config = require '../references/connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryDataUser = "SELECT * FROM users WHERE email = :email";
$queryDataAdmin = "SELECT * FROM admins WHERE email = :email";

if (isset($_SESSION['user'])) {
} else if (isset($_SESSION['admin'])) {
    $stm = $db->prepare($queryDataUser);
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

<?php } else { ?>
    <div class="element">
        <p><strong>Nome: </strong>Ospite</p>
        <p>[Dall'ccount ospite è possibile solamente visualizzare i prodotti in espsosizione]</p>
    </div>

    <div class="element">
        <h4>Accedi come user</h4>
        <form action="account.php" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </form>
    </div>

    <div class="element">
        <h4>Accedi come admin</h4>
        <form action="account.php" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </form>
    </div>
<?php } ?>

<?php require '../references/footer.php' ?>

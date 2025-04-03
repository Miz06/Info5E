<?php
ob_start();
$title = "Account";

require '../references/navbar.php';

$config = require '../references/connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectDataUser = "SELECT * FROM users WHERE email = :email";
$querySelectDataAdmin = "SELECT * FROM admins WHERE email = :email";

if (isset($_POST['email_user']) && isset($_POST['password_user'])) {
    $email = $_POST['email_user'];
    $password = $_POST['password_user'];

    $stm = $db->prepare($querySelectDataUser);
    $stm->bindParam(':email', $email);
    $stm->execute();
    $user = $stm->fetch(PDO::FETCH_ASSOC);

    if ($user && $email == $user['email'] && password_verify($password, $user['password'])) {
        $_SESSION['email_user'] = $user['email'];
        $_SESSION['nome_user'] = $user['nome'];
        header('Location: account.php');
    }

    $stm->closeCursor();
}

if (isset($_POST['email_admin']) && isset($_POST['password_admin'])) {
    $email = $_POST['email_admin'];
    $password = $_POST['password_admin'];

    $stm = $db->prepare($querySelectDataAdmin);
    $stm->bindValue(':email', $email);
    $stm->execute();
    $admin = $stm->fetch(PDO::FETCH_ASSOC);

    if ($admin && $email = $admin['email'] && password_verify($password, $admin['password'])) {
        $_SESSION['email_admin'] = $admin['email'];
        $_SESSION['nome_admin'] = $admin['nome'];
        header('Location: account.php');
    }

    $stm->closeCursor();
}
ob_end_flush();
?>

<?php if (isset($_SESSION['email_user']) && isset($_SESSION['nome_user'])) { ?>
    <div class="element">
        <h4>Info user</h4>
        <hr>
        <p><strong>Nome: </strong> <?= $_SESSION['nome_user'] ?></p>
        <p><strong>Email: </strong> <?= $_SESSION['email_user'] ?></p>
    </div>

    <div class="element">
        <h4>Esci dall'account</h4>
        <a href="../references/logout.php">Logout</a>
    </div>
<?php } else if (isset($_SESSION['email_admin']) && isset($_SESSION['nome_admin'])) { ?>
    <div class="element">
        <h4>Info admin</h4>
        <hr>
        <p><strong>Nome: </strong> <?= $_SESSION['nome_admin'] ?></p>
        <p><strong>Email: </strong> <?= $_SESSION['email_admin'] ?></p>
    </div>

    <div class="element">
        <h4>Esci dall'account</h4>
        <a href="../references/logout.php">Logout</a>
    </div>
<?php } else { ?>
    <div class="element">
        <p><strong>Nome: </strong>Ospite</p>
        <p>[Effettuare login o registrazione per ottenere maggiori funzionalità]</p>
    </div>

    <div class="element">
        <h4>Accedi come user</h4>
        <form action="account.php" method="post">
            <label for="email_user">Email</label>
            <input type="email" id="email_user" name="email_user" required>

            <label for="password_user">Password</label>
            <input type="password" id="password_user" name="password_user" required>

            <input type="submit" value="Accedi">
        </form>
    </div>

    <div class="element">
        <h4>Accedi come admin</h4>
        <form action="account.php" method="post">
            <label for="email_admin">Email</label>
            <input type="email" id="email_admin" name="email_admin" required>

            <label for="password_admin">Password</label>
            <input type="password" id="password_admin" name="password_admin" required>

            <input type="submit" value="Accedi">
        </form>
    </div>

    <div class="element">
        <h4>Non hai un account user? Registrati</h4>
        <a href="./registrazione.php" class="btn-primary log-out">Registrati</a>
    </div>
<?php } ?>

</body>
</html>

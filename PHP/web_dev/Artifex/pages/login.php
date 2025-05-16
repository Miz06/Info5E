<?php
ob_start();
$title = 'login';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectPersona = "SELECT * FROM turisti WHERE email = :email";
$querySelectAmministratore = "SELECT * FROM amministratori WHERE email = :email";

if (isset($_POST['email']) && isset($_POST['password'])) {
    try {
        $stm = $db->prepare($querySelectPersona);
        $stm->bindValue(':email', $_POST['email']);
        $stm->execute();
        $user = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();

        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['nome'] = $user['nome'];

            setcookie('email', $user['email'], time() + 3600, '/');
            setcookie('nome', $user['nome'], time() + 3600, '/');

            header('Location: ./account.php');
            exit;
        } else {
            $stm = $db->prepare($querySelectAmministratore);
            $stm->bindValue(':email', $_POST['email']);
            $stm->execute();
            $user = $stm->fetch(PDO::FETCH_ASSOC);
            $stm->closeCursor();

            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['nome'] = 'Admin';

                setcookie('email', $user['email'], time() + 3600, '/');
                setcookie('nome', 'Admin', time() + 3600, '/');

                header('Location: ./account.php');
                exit;
            }
        }
    } catch (Exception $e) {
        logError($e);
        header('Location: ./login.php');
    }
}
ob_end_flush();
?>

    <form action="login.php" method="post">
        <div class="container">
            <h4><strong>Accedi</strong></h4>
            <hr style="margin-bottom: 3%">
            <label for="email"><strong>Email</strong></label>
            <input type="text" id="email" name="email" required>
            <hr>
            <br>

            <label for="password"><strong>Password</strong></label>
            <input type="password" id="password" name="password" required>
            <hr>
            <br>

            <div class="submit-container">
                <input type="submit" value="Effettua il login">
            </div>
        </div>
    </form>

<?php require '../references/footer.php' ?>
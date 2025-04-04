<?php
ob_start();
$title = 'account';
require '../references/navbar.php';

$config = require '../connectionToDB/databaseConfig.php';; //utilizzo una sessione per evitare di fare nuovamente il require rispetto a $config (vedi navbar)
$db = DBconn::getDB($config);

$queryUpdatePassword = 'UPDATE db_FastRoute.personale SET password = :password WHERE email = :email';
$querySelectUserData = 'SELECT * FROM db_FastRoute.personale WHERE email = :email';

if (isset($_SESSION['email'])) {
    try {
        $stm = $db->prepare($querySelectUserData);
        $stm->bindValue(':email', $_SESSION['email']);
        $stm->execute();

        $userData = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
    }

    if (isset($_POST['password_attuale'])) {
        if (password_verify($_POST['password_attuale'], $userData['password'])) {
            header('location: ../pages/aggiorna_password.php');
        } else {
            $wrongCredentials = "Password errata! Riprovare";
        }
    }
}

if (isset($_COOKIE['email'])) {
    try {
        $stm = $db->prepare($querySelectUserData);
        $stm->bindValue(':email', $_COOKIE['email']);
        $stm->execute();

        $userData = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
    }

    if (isset($_POST['password_attuale'])) {
        if (password_verify($_POST['password_attuale'], $userData['password'])) {
            header('location: ../pages/aggiorna_password.php');
        } else {
            $wrongCredentials = "Password errata! Riprovare";
        }
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (isset($_POST['nav_color'])) {
        $_SESSION['nav_color'] = $_POST['nav_color'];
        header("Location: ./account.php"); // Reindirizzamento
    }
}
ob_end_flush();
?>

<?php if (isset($_SESSION['email']) || isset($_COOKIE['email'])) { ?>
    <div class="element">
        <h4>Info account</h4>
        <hr>
        <p><strong>Nome: </strong> <?= $userData['nome'] ?></p>
        <p><strong>Email: </strong> <?= $userData['email'] ?></p>
        <p><strong>Città: </strong> <?= $userData['citta'] ?></p>
        <p><strong>Via: </strong> <?= $userData['via'] ?></p>
    </div>

    <div class="element">

        <h4>Desideri cambiare password?</h4>
        <hr>
        <?php if(isset($_POST['password_attuale']) && $wrongCredentials) {?>
            <p style="color: red"> <?php echo $wrongCredentials?></p>
        <?php }?>
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
        <form method="post" action="account.php">
            <h4><label for="nav_color">Desideri cambiare tema alla navbar?</label></h4>
            <hr>

            <div class="form-check">
                <input type="radio" id="grey" name="nav_color" value="darkslategrey" class="form-check-input">
                <label for="grey" class="form-check-label">Dark grey</label>
            </div>

            <div class="form-check">
                <input type="radio" id="blu" name="nav_color" value="darkblue" class="form-check-input">
                <label for="blu" class="form-check-label">Dark blu</label>
            </div>

            <div class="form-check">
                <input type="radio" id="nero" name="nav_color" value="#000000" class="form-check-input">
                <label for="nero" class="form-check-label">Nero</label>
            </div>

            <div class="submit-container">
                <input type="submit" value="Salva preferenze">
            </div>
        </form>
    </div>

    <div class="element">
        <h4>Salva le credenziali d'accesso</h4>
        <hr>
        <a href="./set_cookies.php" class="btn-primary btn">Salva credenziali</a>
    </div>

    <div class="element">
        <h4>Esci dall'account</h4>
        <hr>
        <a href="./logout.php" class="btn-primary log-out">Logout</a>
    </div>
<?php } else { ?>
        <div class="element">
    <p><strong>Nome: </strong>Ospite</p>
    <p>[Dall'ccount ospite è usufruibile il servizio di richiesta informazini su servizi previo
        inserimento di un nome e una e-mail.]</p>
        </div>
<?php } ?>

<?php require '../references/footer.php'; ?>
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

    if (isset($_POST['password_attuale'])) {
        if (password_verify($_POST['password_attuale'], $userData['password'])) {
            header('location: ../pages/aggiorna_password.php');
        } else {
            echo 'Password incorretta';
        }
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (isset($_POST['nav_color']) && $_SESSION['email'] != 'Ospite') {
        setcookie('user', $_SESSION['email']);
        setcookie('nav_color', $_POST['nav_color']);
        header("Location: ./account.php"); // Reindirizzamento
    }
}
?>

<?php if (isset($_SESSION['email']) && $_SESSION['email'] != 'Ospite') { ?>
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

            <input type='radio' id='verde' name='nav_color' value='#28a745'>
            <label for="verde">Verde</label>

            <input type='radio' id='blu' name='nav_color' value='#007bff'>
            <label for="blu">Blu</label>

            <input type='radio' id='viola' name='nav_color' value='#6f42c1'>
            <label for="viola">Viola</label>


            <input type='radio' id='nero' name='nav_color' value='#000000'>
            <label for="nero">Nero</label>

            <div class="submit-container">
                <input type="submit" href="./account.php" value="Salva preferenze">
            </div>
        </form>
    </div>

    <div class="element">

        <h4>Esci dall'account</h4>
        <hr>
        <a href="./logout.php" class="btn-primary log-out">Log out</a>
    </div>
<?php } else { ?>
    <p><strong>Nome: </strong>Ospite</p>
    <p>[L'account ospite ha a sua disposizione i servizi di base: sono disponibii maggiori funzionalità solamente previo
        login.]</p>
<?php } ?>

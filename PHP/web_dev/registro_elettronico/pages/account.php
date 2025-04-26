<?php
ob_start();
$title = 'account';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectGenitoriStudenti = "SELECT * FROM genitori_studenti WHERE username_genitore = :username_genitore";
$querySelectRuoloPersona = "SELECT * FROM persone_ruoli WHERE username = :username";

ob_end_flush();
?>

<?php if (isset($_SESSION['username']) || isset($_COOKIE['email'])) { ?>
    <div class="container">
        <h4 style="color: darkred">Info account</h4>
        <hr>
        <p><strong>Username: </strong> <?= $_SESSION['username'] ?></p>
        <p><strong>Nome: </strong> <?= $_SESSION['nome'] ?></p>
        <p><strong>Cognome: </strong> <?= $_SESSION['cognome'] ?></p>
        <?php
        try {
            $stm = $db->prepare($querySelectGenitoriStudenti);
            $stm->bindParam(':username_genitore', $_SESSION['username']);
            $stm->execute();
            $gs = $stm->fetchAll(PDO::FETCH_ASSOC);
            $stm->closeCursor();
        } catch (Exception $e) {
            logError($e);
        }

        try {
            $stm = $db->prepare($querySelectRuoloPersona);
            $stm->bindParam(':username', $_SESSION['username']);
            $stm->execute();
            $pr = $stm->fetchAll(PDO::FETCH_ASSOC);
            $stm->closeCursor();
        } catch (Exception $e) {
            logError($e);
        }


        if ($pr) {
            foreach ($pr as $e) {
                ?>
                <p><strong>Ruolo: </strong> <?= $e['ruolo']?></p><br>
            <?php }
        }

        if ($gs) {
            foreach ($gs as $e) {
                ?>
                <p><strong>Figlio: </strong> <?= $e['username_figlio']?></p>
            <?php }
        } ?>
    </div>

    <div class="container">
        <h4 style="color: darkred">Esci dall'account</h4>
        <hr>
        <a href="../references/logout.php" class="btn-primary log-out">Logout</a>
    </div>
<?php } else { ?>
    <div class="container">
        <p><strong>Nome: </strong>Ospite</p>
        <p>[Dall'account ospite non è usufruibile alcun servizio.]</p>
    </div>

    <div class="container">
        <h4>Effettua l'accesso:</h4><br>
        <a class="login-button" href="login.php">Vai al login</a><hr><br>
    </div>
<?php } ?>

<?php require '../references/footer.php'; ?>

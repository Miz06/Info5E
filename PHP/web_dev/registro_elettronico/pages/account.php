<?php
ob_start();
$title = 'account';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectGenitore = "SELECT * FROM genitori WHERE username = :username";

ob_end_flush();
?>

<?php if (isset($_SESSION['username']) || isset($_COOKIE['email'])) { ?>
    <div class="container">
        <h4 style="color: darkred">Info account</h4>
        <hr>
        <p><strong>Username: </strong> <?= $_SESSION['nome'] ?></p>
        <p><strong>Nome: </strong> <?= $_SESSION['cognome'] ?></p>
        <p><strong>Cognome: </strong> <?= $_SESSION['username'] ?></p>
        <?php
            try{
                $stm = $db -> prepare($querySelectGenitore);
                $stm -> bindParam(':username', $_SESSION['username']);
                $stm->execute();
                $genitore = $stm->fetchAll(PDO::FETCH_ASSOC);
                $stm->closeCursor();
            }catch (Exception $e){
                logError($e);
            }

            if($genitore){
                foreach($genitore){?>
                        <p><strong>Figlio: </strong> <?= $_SESSION['username'] ?></p>
            <?php }}?>
            
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
<?php } ?>

<?php require '../references/footer.php'; ?>

<?php
ob_start();
$title = "account";

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectTurista = 'SELECT * FROM turisti where email = :email';

$turista = '';

if (isset($_SESSION['email']) && $_SESSION['email'] != 'admin@gmail.com') {
    $stm = $db->prepare($querySelectTurista);
    $stm->bindParam(':email', $_SESSION['email']);
    $stm->execute();
    $turista = $stm->fetch(PDO::FETCH_ASSOC);
    $stm->closeCursor();
}
ob_end_flush();
?>

<?php if ($turista) { ?>
    <div class="container">
        <h4>Info account</h4>
        <hr>
        <p><strong>Nome: </strong> <?= $turista['nome'] ?></p>
        <p><strong>Email: </strong> <?= $turista['email'] ?></p>
        <p><strong>Recapito: </strong> <?= $turista['recapito'] ?></p>
        <p><strong>Nazionalità: </strong> <?= $turista['nazionalita'] ?></p>
        <p><strong>Lingua madre: </strong> <?= $turista['lingua_madre'] ?></p>
    </div>

    <div class="container">
        <h4>Cambia password</h4>
        <hr>
        <a href="../pages/aggiorna_password.php" class="btn acc btn-primary">Aggiorna password</a>
    </div>

    <div class="container">
        <h4>Esci dall'account</h4>
        <hr>
        <a href="../references/logout.php" class="btn btn-danger log-out">Logout</a>
    </div>
<?php } else if(isset($_SESSION['email']) && $_SESSION['email'] == 'admin1@gmail.com') { ?>
    <div class="container">
        <h4>Info account</h4>
        <hr>
        <p><strong>Nome: </strong>Admin</p>
        <p>[Questo account ha il massimo delle funzionalità disponibili]</p>
    </div>

    <div class="container">
        <h4>Esci dall'account</h4>
        <hr>
        <a href="../references/logout.php" class="btn btn-danger log-out">Logout</a>
    </div>
<?php } else {?>
    <div class="container">
        <h4>Info account</h4>
        <hr>
        <p><strong>Nome: </strong>Ospite</p>
        <p>[Effettuare login o registrazione per accedere a maggiori funzionalità]</p>
    </div>

    <div class="container">
        <h4>Effettua l'accesso</h4>
        <hr>
        <a href="./login.php" class="btn acc btn-primary">Accedi</a>
    </div>

    <div class="container">
        <h4>Non hai un account? Registrati</h4>
        <hr>
        <a href="./registrazione.php" class="btn acc btn-primary">Registrati</a>
    </div>
<?php } ?>

</body>
</html>

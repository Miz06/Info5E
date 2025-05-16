<?php
ob_start();
$title = "Account";

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectTurista = 'SELECT * FROM turisti where email = :email';
$querySelectPrenotazioni = 'SELECT *
    FROM db_artifex.prenotare s
    JOIN db_artifex.eventi e ON e.id = s.id_evento
    JOIN db_artifex.guide g ON e.id_guida = g.id
    WHERE s.email = :email';

$turista = '';

if (isset($_SESSION['email']) && $_SESSION['email'] != 'admin@gmail.com') {
    $stm = $db->prepare($querySelectTurista);
    $stm->bindParam(':email', $_SESSION['email']);
    $stm->execute();
    $turista = $stm->fetch(PDO::FETCH_ASSOC);
    $stm->closeCursor();

    try {
        $stm = $db->prepare($querySelectPrenotazioni);
        $stm->bindValue(':email', $_SESSION['email']);
        $stm->execute();
        $salvati = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
    }
}
ob_end_flush();
?>

<?php if ($turista) { ?>
    <div class="container">
        <h4><strong>Info account</strong></h4>
        <hr>
        <p><strong>Nome: </strong> <?= $turista['nome'] ?></p>
        <p><strong>Email: </strong> <?= $turista['email'] ?></p>
        <p><strong>Recapito: </strong> <?= $turista['recapito'] ?></p>
        <p><strong>Nazionalità: </strong> <?= $turista['nazionalita'] ?></p>
        <p><strong>Lingua madre: </strong> <?= $turista['lingua_madre'] ?></p>
    </div>

    <div class="container">
        <table><thead>
            <h3><strong>Eventi prenotati</strong></h3><hr>
            <tr><th>Data</th><th>Ora</th><th>Prezzo</th><th>Titolo visita</th><th>Nome guida</th><th>Cognome guida</th></tr>
            </thead><tbody>
            <?php foreach($salvati as $s){ ?>
            <tr>
                <td> <?php echo $s['data'] ?></td>
                <td> <?php echo $s['ora_inizio'] ?></td>
                <td> <?php echo $s['prezzo'] ?> €</td>
                <td> <?php echo $s['titolo_visita']?></td>
                <td> <?php echo $s['nome'] ?></td>
                <td> <?php echo $s['cognome'] ?></td>
                </tr>
                <?php }?>
            </tbody></table>

            </div>

    <div class="container">
        <h4><strong>Cambia password</strong></h4>
        <hr>
        <a href="../pages/aggiorna_password.php" class="btn acc btn-primary">Aggiorna password</a>
    </div>

    <div class="container">
        <h4><strong>Esci dall'account</strong></h4>
        <hr>
        <a href="../references/logout.php" class="btn btn-danger log-out">Logout</a>
    </div>
<?php } else if(isset($_SESSION['email']) && $_SESSION['email'] == 'admin1@gmail.com') { ?>
    <div class="container">
        <h4><strong>Info account</strong></h4>
        <hr>
        <p><strong>Nome: </strong>Admin</p>
        <p>[Questo account ha il massimo delle funzionalità disponibili]</p>
    </div>

    <div class="container">
        <h4><strong>Esci dall'account</strong></h4>
        <hr>
        <a href="../references/logout.php" class="btn btn-danger log-out">Logout</a>
    </div>
<?php } else {?>
    <div class="container">
        <h4><strong>Info account</strong></h4>
        <hr>
        <p><strong>Nome: </strong>Ospite</p>
        <p>[Effettuare login o registrazione per accedere a maggiori funzionalità]</p>
    </div>

    <div class="container">
        <h4><strong>Effettua l'accesso</strong></h4>
        <hr>
        <a href="./login.php" class="btn acc btn-primary">Accedi</a>
    </div>

    <div class="container">
        <h4><strong>Non hai un account? Registrati</strong></h4>
        <hr>
        <a href="./registrazione.php" class="btn acc btn-primary">Registrati</a>
    </div>
<?php } require '../references/footer.php';?>

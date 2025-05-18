<?php
ob_start();
$title = "Account";

require '../references/navbar.php';
require('../vendor/tecnickcom/tcpdf/tcpdf.php');

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectTurista = 'SELECT * FROM turisti where email = :email';
$querySelectPrenotazioni = 'SELECT 
    p.*, 
    e.*, 
    g.nome AS nome_guida, 
    g.cognome AS cognome_guida, 
    t.nome AS nome_turista, 
    t.cognome AS cognome_turista,
    v.*
FROM db_artifex.prenotare p
JOIN db_artifex.eventi e ON e.id = p.id_evento
JOIN db_artifex.guide g ON e.id_guida = g.id 
JOIN db_artifex.visite v ON e.titolo_visita = v.titolo 
JOIN db_artifex.turisti t ON t.email = p.email 
WHERE p.email = :email';

$turista = '';
$prenotazioni = [];

if (isset($_SESSION['email']) && $_SESSION['email'] != 'admin@gmail.com') {
    try {
        $stm = $db->prepare($querySelectTurista);
        $stm->bindParam(':email', $_SESSION['email']);
        $stm->execute();
        $turista = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();

        $stm = $db->prepare($querySelectPrenotazioni);
        $stm->bindValue(':email', $_SESSION['email']);
        $stm->execute();
        $prenotazioni = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
    }
}

if (isset($_POST['evento_selezionato'])) {
    foreach ($prenotazioni as $prenotazione) {
        if ($prenotazione['id_evento'] == $_POST['evento_selezionato']) {
            ob_end_clean(); // per evitare errori di buffer
            $pdf = new TCPDF();
            $pdf->AddPage();
            $current = date("d/m/y");
            $pdf->Ln(5);
            $pdf->Cell(0, 10, 'Ticket evento', 0, 1, "C");
            $pdf->Ln(5);
            $pdf->Cell(0, 10, 'Nome e cognome turista: ' . $prenotazione['nome_turista'] . ' ' . $prenotazione['cognome_turista'], 0, 1);
            $pdf->Cell(0, 10, "Data di stampa: " . $current, 0, 1);
            $pdf->Cell(0, 10, "Titolo: " . $prenotazione['titolo_visita'], 0, 1);
            $pdf->Cell(0, 10, "Luogo: " . $prenotazione['luogo'], 0, 1);
            $pdf->Cell(0, 10, "Data e ora: " . $prenotazione['data'] . ' - ' . $prenotazione['ora_inizio'], 0, 1);
            $pdf->Cell(0, 10, "Nome e cognome guida: " . $prenotazione['nome_guida'] . " " . $prenotazione['cognome_guida'], 0, 1);
            $pdf->write2DBarcode("[Nome e cognome turista: {$prenotazione['nome_turista']} {$prenotazione['cognome_turista']}] - [Data di stampa: {$current}] - [Titolo visita: {$prenotazione['titolo_visita']}] - [Luogo: {$prenotazione['luogo']}] - [Data e ora: {$prenotazione['data']} {$prenotazione['ora_inizio']}] - [Nome e cognome guida: {$prenotazione['nome_guida']} {$prenotazione['cognome_guida']}]", 'QRCODE,L', 10, $pdf->GetY() + 5, 50, 50, [], 'N');
            $pdf->Ln(60);

        }
    }
    $pdf->Output("Ticket.pdf", "I");
    exit;
}
?>

<?php if ($turista) { ?>
    <div class="container">
        <h4><strong>Info account</strong></h4>
        <hr>
        <p><strong>Nome: </strong> <?= $turista['nome'] ?></p>
        <p><strong>Cognome: </strong> <?= $turista['cognome'] ?></p>
        <p><strong>Email: </strong> <?= $turista['email'] ?></p>
        <p><strong>Recapito: </strong> <?= $turista['recapito'] ?></p>
        <p><strong>Nazionalità: </strong> <?= $turista['nazionalita'] ?></p>
        <p><strong>Lingua madre: </strong> <?= $turista['lingua_madre'] ?></p>
    </div>

    <div class="container">
        <?php if ($prenotazioni) { ?>
            <form action="account.php" method="post">
                <table>
                    <thead>
                    <h3><strong>Eventi prenotati</strong></h3>
                    <hr>
                    <tr>
                        <th>Stampa</th>
                        <th>Data</th>
                        <th>Ora</th>
                        <th>Prezzo</th>
                        <th>Titolo visita</th>
                        <th>Nome guida</th>
                        <th>Cognome guida</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($prenotazioni as $p) { ?>
                        <tr>
                            <td><input type="radio" name="evento_selezionato" value="<?php echo $p['id_evento'] ?>">
                            </td>
                            <td> <?php echo $p['data'] ?></td>
                            <td> <?php echo $p['ora_inizio'] ?></td>
                            <td> <?php echo $p['prezzo'] ?> €</td>
                            <td> <?php echo $p['titolo_visita'] ?></td>
                            <td> <?php echo $p['nome_guida'] ?></td>
                            <td> <?php echo $p['cognome_guida'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <br>
                <div class="submit-container"><input type="submit" value="Stampa PDF"></div>
            </form>
        <?php } else { ?>
            <h6><strong>Non hai ancora prenotato un evento</strong></h6>
            <hr>
        <?php } ?>
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
<?php } else if (isset($_SESSION['email']) && $_SESSION['email'] == 'admin1@gmail.com') { ?>
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
<?php } else { ?>
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
<?php }
require '../references/footer.php'; ?>

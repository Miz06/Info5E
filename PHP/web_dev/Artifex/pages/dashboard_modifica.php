<?php
ob_start();
$title = 'Dashboard - [Modifica]';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryUpdateEvento = 'UPDATE eventi 
    SET data = :data_evento, 
        ora_inizio = :ora_inizio, 
        prezzo = :prezzo, 
        min_partecipanti = :min_partecipanti, 
        max_partecipanti = :max_partecipanti, 
        titolo_visita = :titolo_visita, 
        id_guida = :id_guida 
    WHERE id = :id_evento';

$queryUpdateGuida = 'UPDATE guide 
    SET cognome = :cognome, 
        nome = :nome, 
        data_nascita = :data_nascita, 
        luogo_nascita = :luogo_nascita 
    WHERE id = :id_guida';

$queryUpdateVisita = 'UPDATE visite 
    SET durata_media = :durata_media, 
        luogo = :luogo 
    WHERE titolo = :titolo';

if (isset($_POST['modifica_Id_evento']) && isset($_POST['data_evento']) && isset($_POST['ora_inizio']) && isset($_POST['prezzo']) && isset($_POST['min_partecipanti']) && isset($_POST['max_partecipanti']) && isset($_POST['id_guida'])) {
    try {
        $stm = $db->prepare($queryUpdateEvento);
        $stm->bindValue('data_evento', $_POST['data_evento']);
        $stm->bindValue('ora_inizio', $_POST['ora_inizio']);
        $stm->bindValue('prezzo', $_POST['prezzo']);
        $stm->bindValue('min_partecipanti', $_POST['min_partecipanti']);
        $stm->bindValue('max_partecipanti', $_POST['max_partecipanti']);
        $stm->bindValue('titolo_visita', $_POST['titolo_visita']);
        $stm->bindValue('id_guida', $_POST['id_guida']);
        $stm->bindValue('id_evento', $_POST['modifica_Id_evento']);
        $stm->execute();
        $stm->closeCursor();
        header("Location: ./dashboard.php");
        exit;
    } catch (Exception $e) {
        logError($e);
    }
}

if (isset($_POST['modifica_Id_guida']) && isset($_POST['cognome']) && isset($_POST['nome']) && isset($_POST['data_nascita']) && isset($_POST['luogo_nascita'])) {
    try {
        $stm = $db->prepare($queryUpdateGuida);
        $stm->bindValue('cognome', $_POST['cognome']);
        $stm->bindValue('nome', $_POST['nome']);
        $stm->bindValue('data_nascita', $_POST['data_nascita']);
        $stm->bindValue('luogo_nascita', $_POST['luogo_nascita']);
        $stm->bindValue('id_guida', $_POST['modifica_Id_guida']);
        $stm->execute();
        $stm->closeCursor();
        header("Location: ./dashboard.php");
        exit;
    } catch (Exception $e) {
        logError($e);
    }
}

if (isset($_POST['titolo']) && isset($_POST['durata_media']) && isset($_POST['luogo'])) {
    try {
        $stm = $db->prepare($queryUpdateVisita);
        $stm->bindValue('titolo', $_POST['titolo']);
        $stm->bindValue('durata_media', $_POST['durata_media']);
        $stm->bindValue('luogo', $_POST['luogo']);
        $stm->execute();
        $stm->closeCursor();
        header("Location: ./dashboard.php");
        exit;
    } catch (Exception $e) {
        logError($e);
    }
}
?>

    <div class="container my-4" style="border: 2px solid red">
        <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['modifica_Id_evento'])) {//MODIFICA EVENTO
            try {
                $stm = $db->prepare("SELECT * FROM eventi WHERE id = :id");
                $stm->bindParam(":id", $_POST['modifica_Id_evento']);
                $stm->execute();
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                $stm->CloseCursor();
                if (!$data) {
                    header("location: ./account.php");
                    exit;
                }
            } catch (Exception $e) {
                logError($e);
            }
            ?>
            <h3><strong>Modifica evento</strong></h3>
            <hr>
            <form action="dashboard_modifica.php" method="post">
                <label for="data_evento"><strong>Data evento</strong></label>
                <input type="date" id="data_evento" name="data_evento" value="<?php echo $data['data'] ?>" required>
                <hr>

                <label for="ora_inizio"><strong>Orario inizio evento</strong></label>
                <input type="time" id="ora_inizio" name="ora_inizio" value="<?php echo $data['ora_inizio'] ?>" required>
                <hr>

                <label for="prezzo"><strong>Prezzo evento (€)</strong></label>
                <input type="number" id="prezzo" name="prezzo" value="<?php echo $data['prezzo'] ?>" required>
                <hr>

                <label for="min_partecipanti"><strong>Minimo partecipanti evento</strong></label>
                <input type="number" id="min_partecipanti" name="min_partecipanti" min="0"
                       value="<?php echo $data['min_partecipanti'] ?>" required>
                <hr>

                <label for="max_partecipanti"><strong>Massimo partecipanti evento</strong></label>
                <input type="number" id="max_partecipanti" name="max_partecipanti" min="0"
                       value="<?php echo $data['max_partecipanti'] ?>" required>
                <hr>

                <label for="titolo_visita"><strong>Titolo visita evento</strong></label>
                <input type="text" id="titolo_visita" name="titolo_visita" value="<?php echo $data['titolo_visita'] ?>"
                       required>
                <hr>

                <label for="id_guida"><strong>Id guida evento</strong></label>
                <input type="number" id="id_guida" name="id_guida" value="<?php echo $data['id_guida'] ?>" required>
                <hr>

                <input type="hidden" name="modifica_Id_evento" value="<?php echo $data['id']; ?>">

                <div class="submit-container">
                    <input type="submit" value="Inserisci modifiche evento">
                </div>
            </form>
        <?php } ?>

        <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['modifica_Id_guida'])) {//MODIFICA GUIDA
            try {
                $stm = $db->prepare("SELECT * FROM guide WHERE id = :id");
                $stm->bindParam(":id", $_POST['modifica_Id_guida']);
                $stm->execute();
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                $stm->CloseCursor();

                if (!$data) {
                    header("location: ./account.php");
                    exit;
                }
            } catch (Exception $e) {
                logError($e);
            }

            ?>
            <h3><strong>Modifica guida</strong></h3>
            <hr>
            <form action="dashboard_modifica.php" method="post">
                <label for="cognome"><strong>Cognome guida</strong></label>
                <input type="text" id="cognome" name="cognome" value="<?php echo $data['cognome'] ?>" required>
                <hr>

                <label for="nome"><strong>Nome guida</strong></label>
                <input type="text" id="nome" name="nome" value="<?php echo $data['nome'] ?>" required>
                <hr>

                <label for="data_nascita"><strong>Data di nascita guida</strong></label>
                <input type="date" id="data_nascita" name="data_nascita" value="<?php echo $data['data_nascita'] ?>"
                       required>
                <hr>

                <label for="luogo_nascita"><strong>Luogo di nascita guida</strong></label>
                <input type="text" id="luogo_nascita" name="luogo_nascita" value="<?php echo $data['luogo_nascita'] ?>"
                       required>
                <hr>

                <input type="hidden" name="modifica_Id_guida" value="<?php echo $data['id']; ?>">

                <div class="submit-container">
                    <input type="submit" value="Inserisci modifiche guida">
                </div>
            </form>
        <?php } ?>

        <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['modifica_titolo_visita'])) {//MODIFICA VISITA
            try {
                $stm = $db->prepare("SELECT * FROM visite WHERE titolo = :titolo");
                $stm->bindParam(":titolo", $_POST['modifica_titolo_visita']);
                $stm->execute();
                $data = $stm->fetch(PDO::FETCH_ASSOC);
                $stm->CloseCursor();

                if (!$data) {
                    header("location: ./account.php");
                    exit;
                }
            } catch (Exception $e) {
                logError($e);
            }
            ?>
            <h3><strong>Modifica visita</strong></h3>
            <hr>
            <form action="dashboard_modifica.php" method="post">
                <label for="titolo"><strong>Titolo visita</strong></label>
                <input type="text" id="titolo" name="titolo" value="<?php echo $data['titolo'] ?>" required>
                <hr>

                <label for="durata_media"><strong>Durata media visita</strong></label>
                <input type="time" id="durata_media" name="durata_media" value="<?php echo $data['durata_media'] ?>"
                       required>
                <hr>

                <label for="luogo"><strong>Luogo visita</strong></label>
                <input type="text" id="luogo" name="luogo" value="<?php echo $data['luogo'] ?>" required>
                <hr>

                <div class="submit-container">
                    <input type="submit" value="Inserisci modifiche visita">
                </div>
            </form>
        <?php } ?>
    </div>

<?php ob_end_flush();
require '../references/footer.php'; ?>
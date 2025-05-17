<?php
ob_start();
$title = 'Dashboard';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

if(isset($_POST['modifica_Id_guida'])){
    try{
        $stm = $db->prepare("SELECT * FROM guide WHERE id_guida = :id_guida");
        $stm->bindParam(":id_guida", $_POST['modifica_Id_guida']);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->CloseCursor();

        if(!$data){
            header("location: ../dashboard.php");
        }
    }catch (Exception $e){
        logError($e);
    }
}

if(isset($_POST['modifica_Id_evento']))

if(isset($_POST['modifica_titolo_visita']))

?>

<div class="container my-4" style="border: 2px solid red">

    <?php if (isset($_POST['modifica_Id_guida'])) { ?>
        <!-- MODIFICA EVENTO-->
        <h3><strong>Modifica evento</strong></h3>
        <hr>
        <form action="dashboard.php" method="post">
            <label for="data_evento"><strong>Data evento</strong></label>
            <input type="date" id="data_evento" name="data_evento" required>
            <hr>

            <label for="ora_inizio"><strong>Orario inizio evento</strong></label>
            <input type="time" id="ora_inizio" name="ora_inizio" required>
            <hr>

            <label for="prezzo"><strong>Prezzo evento (€)</strong></label>
            <input type="number" id="prezzo" name="prezzo" required>
            <hr>

            <label for="min_partecipanti"><strong>Minimo partecipanti evento</strong></label>
            <input type="number" id="min_partecipanti" name="min_partecipanti" min="0" required>
            <hr>

            <label for="max_partecipanti"><strong>Massimo partecipanti evento</strong></label>
            <input type="number" id="max_partecipanti" name="max_partecipanti" min="0" required>
            <hr>

            <label for="titolo_visita"><strong>Titolo visita evento</strong></label>
            <input type="text" id="titolo_visita" name="titolo_visita" required>
            <hr>

            <label for="id_guida"><strong>Id guida evento</strong></label>
            <input type="number" id="id_guida" name="id_guida" required>
            <hr>

            <div class="submit-container">
                <input type="submit" value="Inserisci evento">
            </div>
        </form>
    <?php } ?>

    <?php if (isset($_POST['modifica_Id_evento'])) { ?>
        <!-- MODIFICA GUIDA-->
        <h3><strong>Modifica guida</strong></h3>
        <hr>
        <form action="dashboard.php" method="post">
            <label for="cognome"><strong>Cognome guida</strong></label>
            <input type="text" id="cognome" name="cognome" required>
            <hr>

            <label for="nome"><strong>Nome guida</strong></label>
            <input type="text" id="nome" name="nome" required>
            <hr>

            <label for="data_nascita"><strong>Data di nascita guida</strong></label>
            <input type="date" id="data_nascita" name="data_nascita" required>
            <hr>

            <label for="luogo_nascita"><strong>Luogo di nascita guida</strong></label>
            <input type="text" id="luogo_nascita" name="luogo_nascita" required>
            <hr>

            <label for="lingua_conosciuta"><strong>Lingua conosciuta</strong></label>
            <input type="text" id="lingua_conosciuta" name="lingua_conosciuta" required>
            <hr>

            <label for="titolo_guida"><strong>Titolo di studio</strong></label>
            <input type="text" id="titolo_guida" name="titolo_guida" required>
            <hr>

            <div class="submit-container">
                <input type="submit" value="Inserisci">
            </div>
        </form>
    <?php } ?>

    <?php if (isset($_POST['modifica_titolo_visita'])) { ?>
        <!-- MODIFICA VISITA-->
        <h3><strong>Modifica visita</strong></h3>
        <hr>
        <form action="dashboard.php" method="post">
            <label for="titolo"><strong>Titolo visita</strong></label>
            <input type="text" id="titolo" name="titolo" required>
            <hr>

            <label for="durata_media"><strong>Durata media visita</strong></label>
            <input type="time" id="durata_media" name="durata_media" required>
            <hr>

            <label for="luogo"><strong>Luogo visita</strong></label>
            <input type="text" id="luogo" name="luogo" required>
            <hr>

            <div class="submit-container">
                <input type="submit" value="Inserisci">
            </div>
        </form>
    <?php } ?>
</div>

<?php require '../references/footer.php'; ?>

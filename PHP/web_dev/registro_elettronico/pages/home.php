<?php
$title = 'home';
require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectGenitoriStudenti = "SELECT * FROM genitori_studenti WHERE username_genitore = :username_genitore";
$querySelectRuoloPersona = "SELECT * FROM persone_ruoli WHERE username = :username";
$querySelectPersona = "SELECT * FROM persone WHERE username = :username";
$querySelectClassePersona = "SELECT * FROM studenti_classi WHERE username = :username";
$querySelectClasseIndirizzoArticolazione = "SELECT * FROM classe_indirizzo_articolazione WHERE classe = :classe";
$querySelectPDS = "SELECT * FROM PDS WHERE articolazione = :articolazione";
$querySelectMaterie = "SELECT * FROM PDS_materie WHERE id = :id";
$querySelectDocente = "SELECT * FROM docenti_classi WHERE username = :username";

try {
    $stm = $db->prepare($querySelectRuoloPersona);
    $stm->bindParam(':username', $_SESSION['username']);
    $stm->execute();
    $pr = $stm->fetch(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

try {
    $stm = $db->prepare($querySelectGenitoriStudenti);
    $stm->bindParam(':username_genitore', $_SESSION['username']);
    $stm->execute();
    $gs = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

?>

<?php if ($pr) {
    if ($pr['ruolo'] == 'genitore') {
        if ($gs) {
            ?>
            <div class="container">
            <h4 style="color: darkred">Info figlio/i</h4>
            <hr>
            <?php
            foreach ($gs as $g) {
                try {
                    $stm = $db->prepare($querySelectPersona);
                    $stm->bindParam(':username', $g['username_figlio']);
                    $stm->execute();
                    $studente = $stm->fetch(PDO::FETCH_ASSOC); //username + nome + cognome + password
                    $stm->closeCursor();
                } catch (Exception $e) {
                    logError($e);
                }

                try {
                    $stm = $db->prepare($querySelectClassePersona);
                    $stm->bindParam(':username', $g['username_figlio']);
                    $stm->execute();
                    $tupla = $stm->fetch(PDO::FETCH_ASSOC); //studente + classe
                    $stm->closeCursor();
                } catch (Exception $e) {
                    logError($e);
                }

                try {
                    $stm = $db->prepare($querySelectClasseIndirizzoArticolazione);
                    $stm->bindParam(':classe', $tupla['id']);
                    $stm->execute();
                    $classe = $stm->fetch(PDO::FETCH_ASSOC); //classe + indirizzo + articolazione
                    $stm->closeCursor();
                } catch (Exception $e) {
                    logError($e);
                }

                try {
                    $stm = $db->prepare($querySelectPDS);
                    $stm->bindParam(':articolazione', $classe['articolazione']);
                    $stm->execute();
                    $PDS = $stm->fetch(PDO::FETCH_ASSOC); //id + descrizione + articolazione
                    $stm->closeCursor();
                } catch (Exception $e) {
                    logError($e);
                }

                try {
                    $stm = $db->prepare($querySelectMaterie);
                    $stm->bindParam(':id', $PDS['id']);
                    $stm->execute();
                    $materie = $stm->fetchAll(PDO::FETCH_ASSOC); //id + materia
                    $stm->closeCursor();
                } catch (Exception $e) {
                    logError($e);
                }

                ?>
                <p><strong>Username: </strong> <?= $studente['username'] ?></p>
                <p><strong>Nome: </strong> <?= $studente['nome'] ?></p>
                <p><strong>Cognome: </strong> <?= $studente['cognome'] ?></p>
                <p><strong>Classe: </strong> <?= $classe['classe'] ?></p>
                <p><strong>Articolazione: </strong> <?= $classe['articolazione'] ?></p>
                <p><strong>Indirizzo: </strong> <?= $classe['indirizzo'] ?></p>
                <p><strong>Piano di studio: </strong> <?= $PDS['descrizione'] ?></p>
                <p><strong>Materie: </strong>
                    <?php foreach ($materie as $materia) { ?>
                        <?= $materia['materia'] . '; ' ?>
                    <?php } ?></p>
                <hr>
            <?php } ?>
            </div><?php
        } ?>
    <?php } else if ($pr['ruolo'] == 'studente') {
        try {
            $stm = $db->prepare($querySelectClassePersona);
            $stm->bindParam(':username', $_SESSION['username']);
            $stm->execute();
            $tupla = $stm->fetch(PDO::FETCH_ASSOC); //studente + classe
            $stm->closeCursor();
        } catch (Exception $e) {
            logError($e);
        }

        try {
            $stm = $db->prepare($querySelectClasseIndirizzoArticolazione);
            $stm->bindParam(':classe', $tupla['id']);
            $stm->execute();
            $classe = $stm->fetch(PDO::FETCH_ASSOC); //classe + indirizzo + articolazione
            $stm->closeCursor();
        } catch (Exception $e) {
            logError($e);
        }

        try {
            $stm = $db->prepare($querySelectPDS);
            $stm->bindParam(':articolazione', $classe['articolazione']);
            $stm->execute();
            $PDS = $stm->fetch(PDO::FETCH_ASSOC); //id + descrizione + articolazione
            $stm->closeCursor();
        } catch (Exception $e) {
            logError($e);
        }

        try {
            $stm = $db->prepare($querySelectMaterie);
            $stm->bindParam(':id', $PDS['id']);
            $stm->execute();
            $materie = $stm->fetchAll(PDO::FETCH_ASSOC); //id + materia
            $stm->closeCursor();
        } catch (Exception $e) {
            logError($e);
        }

        ?>
        <div class="container">
            <h4 style="color: darkred">Info dati scolastici</h4>
            <hr>
            <p><strong>Classe: </strong> <?= $classe['classe'] ?></p>
            <p><strong>Articolazione: </strong> <?= $classe['articolazione'] ?></p>
            <p><strong>Indirizzo: </strong> <?= $classe['indirizzo'] ?></p>
            <p><strong>Piano di studio: </strong> <?= $PDS['descrizione'] ?></p>
            <p><strong>Materie: </strong>
                <?php foreach ($materie as $materia) { ?>
                    <?= $materia['materia'] . '; ' ?>
                <?php } ?></p>
        </div>

    <?php } else if ($pr['ruolo'] == 'insegnante') { ?>
        <div class="container">
        <h4 style="color: darkred">Info classe/i</h4>
        <hr>
        <?php
        try {
            $stm = $db->prepare($querySelectDocente);
            $stm->bindParam(':username', $_SESSION['username']);
            $stm->execute();
            $tuple = $stm->fetchAll(PDO::FETCH_ASSOC); //docente + classe
            $stm->closeCursor();
        } catch (Exception $e) {
            logError($e);
        }

        foreach ($tuple as $t) {
            try {
                $stm = $db->prepare($querySelectClasseIndirizzoArticolazione);
                $stm->bindParam(':classe', $t['id']);
                $stm->execute();
                $classe = $stm->fetch(PDO::FETCH_ASSOC); //classe + indirizzo + articolazione
                $stm->closeCursor();
            } catch (Exception $e) {
                logError($e);
            }

            try {
                $stm = $db->prepare($querySelectPDS);
                $stm->bindParam(':articolazione', $classe['articolazione']);
                $stm->execute();
                $PDS = $stm->fetch(PDO::FETCH_ASSOC); //id + descrizione + articolazione
                $stm->closeCursor();
            } catch (Exception $e) {
                logError($e);
            }

            try {
                $stm = $db->prepare($querySelectMaterie);
                $stm->bindParam(':id', $PDS['id']);
                $stm->execute();
                $materie = $stm->fetchAll(PDO::FETCH_ASSOC); //id + materia
                $stm->closeCursor();
            } catch (Exception $e) {
                logError($e);
            } ?>

            <p><strong>Classe: </strong> <?= $classe['classe'] ?></p>
            <p><strong>Articolazione: </strong> <?= $classe['articolazione'] ?></p>
            <p><strong>Indirizzo: </strong> <?= $classe['indirizzo'] ?></p>
            <p><strong>Piano di studio: </strong> <?= $PDS['descrizione'] ?></p>
            <p><strong>Materie: </strong>
                <?php foreach ($materie as $materia) { ?>
                    <?= $materia['materia'] . '; ' ?>
                <?php } ?></p>
            <hr>
        <?php }?>
        </div>
        <?php
    }
} ?>

<?php
require '../references/footer.php';
?>


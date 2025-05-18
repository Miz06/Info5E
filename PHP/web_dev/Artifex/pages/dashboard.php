<?php
ob_start();
$title = 'Dashboard';

require '../references/navbar.php';
require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$querySelectGuide = 'SELECT * FROM guide';
$querySelectEventi = 'SELECT * FROM eventi';
$querySelectVisite = 'SELECT * FROM visite';
$querySelectConoscere = 'SELECT * FROM conoscere';
$querySelectAvere = 'SELECT * FROM db_artifex.avere';
$querySelectTitoli = 'SELECT * FROM db_artifex.titoli WHERE nome = :titolo';
$querySelectLingue = 'SELECT * FROM db_artifex.lingue WHERE nome = :nome';

$queryInsertIntoEventi = 'INSERT INTO db_artifex.eventi (data, ora_inizio, prezzo, min_partecipanti, max_partecipanti, titolo_visita, id_guida) VALUES (:data_evento, :ora_inizio, :prezzo, :min_partecipanti, :max_partecipanti, :titolo_visita, :id_guida)';
$queryInsertIntoGuide = 'INSERT INTO db_artifex.guide (cognome, nome, data_nascita, luogo_nascita) VALUES (:cognome, :nome, :data_nascita, :luogo_nascita)';
$queryInsertIntoVisite = 'INSERT INTO db_artifex.visite (titolo, durata_media, luogo) VALUES (:titolo, :durata_media, :luogo)';
$queryInsertIntoConoscere = 'INSERT INTO db_artifex.conoscere (nome, id_guida) VALUES (:nome, :id_guida)';
$queryInsertIntoAvere = 'INSERT INTO db_artifex.avere (id_guida, titolo) VALUES (:id_guida, :titolo)';
$queryInsertIntoLingue = 'INSERT INTO db_artifex.lingue (nome) VALUES (:nome)';
$queryInsertIntoTitoli = 'INSERT INTO db_artifex.titoli (nome) VALUES (:nome)';

//SELECT
try {
    $stm = $db->prepare($querySelectGuide);
    $stm->execute();
    $guide = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

try {
    $stm = $db->prepare($querySelectVisite);
    $stm->execute();
    $visite = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

try {
    $stm = $db->prepare($querySelectEventi);
    $stm->execute();
    $eventi = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

try {
    $stm = $db->prepare($querySelectConoscere);
    $stm->execute();
    $conoscere = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

try {
    $stm = $db->prepare($querySelectAvere);
    $stm->execute();
    $avere = $stm->fetchAll(PDO::FETCH_ASSOC);
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

//INSERIMENTI
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //EVENTI
    if (isset($_POST['data_evento']) && isset($_POST['ora_inizio']) && isset($_POST['prezzo']) && isset($_POST['min_partecipanti']) && isset($_POST['max_partecipanti']) && isset($_POST['titolo_visita']) && isset($_POST['id_guida'])) {
        try {
            $stm = $db->prepare($queryInsertIntoEventi);
            $stm->bindValue('data_evento', $_POST['data_evento']);
            $stm->bindValue('ora_inizio', $_POST['ora_inizio']);
            $stm->bindValue('prezzo', $_POST['prezzo']);
            $stm->bindValue('min_partecipanti', $_POST['min_partecipanti']);
            $stm->bindValue('max_partecipanti', $_POST['max_partecipanti']);
            $stm->bindValue('titolo_visita', $_POST['titolo_visita']);
            $stm->bindValue('id_guida', $_POST['id_guida']);
            $stm->execute();
            $stm->closeCursor();

            header("Location: ./dashboard.php");
        } catch (Exception $e) {
            logError($e);
        }
    } //VISITE
    elseif (isset($_POST['titolo']) && isset($_POST['durata_media']) && isset($_POST['luogo'])) {
        try {
            $stm = $db->prepare($queryInsertIntoVisite);
            $stm->bindValue('titolo', $_POST['titolo']);
            $stm->bindValue('durata_media', $_POST['durata_media']);
            $stm->bindValue('luogo', $_POST['luogo']);
            $stm->execute();
            $stm->closeCursor();
            header("Location: ./dashboard.php");
        } catch (Exception $e) {
            logError($e);
        }
    } //GUIDE
    elseif (isset($_POST['cognome']) && isset($_POST['nome']) && isset($_POST['data_nascita']) && isset($_POST['luogo_nascita'])) {
        try {
            $stm = $db->prepare($queryInsertIntoGuide);
            $stm->bindValue('cognome', $_POST['cognome']);
            $stm->bindValue('nome', $_POST['nome']);
            $stm->bindValue('data_nascita', $_POST['data_nascita']);
            $stm->bindValue('luogo_nascita', $_POST['luogo_nascita']);
            $stm->execute();
            $lastInsertId = $db->lastInsertId();
            $stm->closeCursor();

            if (isset($_POST['lingua_conosciuta'])) {
                try {
                    $stm = $db->prepare($querySelectLingue);
                    $stm->bindValue('nome', $_POST['lingua_conosciuta']);
                    $stm->execute();
                    $data = $stm->fetch(PDO::FETCH_ASSOC);
                    $stm->closeCursor();
                } catch (Exception $e) {
                    logError($e);
                }

                if (!$data) {
                    try {
                        $stm = $db->prepare($queryInsertIntoLingue);
                        $stm->bindValue('nome', $_POST['lingua_conosciuta']);
                        $stm->execute();
                        $data = $stm->fetch(PDO::FETCH_ASSOC);
                        $stm->closeCursor();
                    } catch (Exception $e) {
                        logError($e);
                    }
                }

                try {
                    $stm = $db->prepare($queryInsertIntoConoscere);
                    $stm->bindValue(':nome', $_POST['lingua_conosciuta']);
                    $stm->bindvalue(':id_guida', $lastInsertId);
                    $stm->execute();
                    $stm->closeCursor();
                } catch (Exception $e) {
                    logError($e);
                }
            }

            if (isset($_POST['titolo_guida'])) {
                try {
                    $stm = $db->prepare($querySelectTitoli);
                    $stm->bindValue('nome', $_POST['titolo_guida']);
                    $stm->execute();
                    $data = $stm->fetch(PDO::FETCH_ASSOC);
                    $stm->closeCursor();
                } catch (Exception $e) {
                    logError($e);
                }

                if (!$data) {
                    try {
                        $stm = $db->prepare($queryInsertIntoTitoli);
                        $stm->bindValue('nome', $_POST['titolo_guida']);
                        $stm->execute();
                        $stm->closeCursor();
                    } catch (Exception $e) {
                        logError($e);
                    }
                }

                try {
                    $stm = $db->prepare($queryInsertIntoAvere);
                    $stm->bindValue(':titolo', $_POST['titolo_guida']);
                    $stm->bindvalue(':id_guida', $lastInsertId);
                    $stm->execute();
                    $stm->closeCursor();
                } catch (Exception $e) {
                    logError($e);
                }
            }
            header("Location: ./dashboard.php");
        } catch (Exception $e) {
            logError($e);
        }
    }
}
echo '<div class="container my-4">';

echo '<div class="accordion" id="dashboardAccordion">';
echo '<h3><strong>Visualizza</strong></h3><hr>';

// EVENTI
echo '
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingEventi">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEventi" aria-expanded="true" aria-controls="collapseEventi">
        Eventi
      </button>
    </h2>
    <div id="collapseEventi" class="accordion-collapse collapse" aria-labelledby="headingEventi">
      <div class="accordion-body">
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>Id evento</th><th>Data</th><th>Ora</th><th>Prezzo</th>
              <th>Minimo partecipanti</th><th>Massimo partecipanti</th>
              <th>Titolo visita</th><th>Id guida</th>
            </tr>
          </thead>
          <tbody>';
foreach ($eventi as $e) {
    echo '<tr>';
    echo '<td>' . $e['id'] . '</td>';
    echo '<td>' . $e['data'] . '</td>';
    echo '<td>' . $e['ora_inizio'] . '</td>';
    echo '<td>' . $e['prezzo'] . '</td>';
    echo '<td>' . $e['min_partecipanti'] . '</td>';
    echo '<td>' . $e['max_partecipanti'] . '</td>';
    echo '<td>' . $e['titolo_visita'] . '</td>';
    echo '<td>' . $e['id_guida'] . '</td>';
    echo '</tr>';
}
echo '</tbody></table>
      </div>
    </div>
  </div>';

// GUIDE
echo '
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingGuide">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGuide" aria-expanded="false" aria-controls="collapseGuide">
        Guide
      </button>
    </h2>
    <div id="collapseGuide" class="accordion-collapse collapse" aria-labelledby="headingGuide">
      <div class="accordion-body">
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>Id guida</th><th>Lingue parlate</th><th>Titolo/i di studio</th>
              <th>Nome</th><th>Cognome</th><th>Data di nascita</th><th>Luogo di nascita</th>
            </tr>
          </thead>
          <tbody>';
foreach ($guide as $g) {
    echo '<tr>';
    echo '<td>' . $g['id'] . '</td>';

    // Lingue
    $lingue = [];
    foreach ($conoscere as $c) {
        if ($c['id_guida'] == $g['id']) {
            $lingue[] = $c['nome'];
        }
    }
    echo '<td>' . implode(', ', $lingue) . '</td>';

    // Titoli
    $titoli = [];
    foreach ($avere as $a) {
        if ($a['id_guida'] == $g['id']) {
            $titoli[] = $a['titolo'];
        }
    }
    echo '<td>' . implode(', ', $titoli) . '</td>';

    echo '<td>' . $g['nome'] . '</td>';
    echo '<td>' . $g['cognome'] . '</td>';
    echo '<td>' . $g['data_nascita'] . '</td>';
    echo '<td>' . $g['luogo_nascita'] . '</td>';
    echo '</tr>';
}
echo '</tbody></table>
      </div>
    </div>
  </div>';

// VISITE
echo '
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingVisite">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVisite" aria-expanded="false" aria-controls="collapseVisite">
        Visite
      </button>
    </h2>
    <div id="collapseVisite" class="accordion-collapse collapse" aria-labelledby="headingVisite">
      <div class="accordion-body">
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr><th>Titolo</th><th>Durata media</th><th>Luogo</th></tr>
          </thead>
          <tbody>';
foreach ($visite as $v) {
    echo '<tr>';
    echo '<td>' . $v['titolo'] . '</td>';
    echo '<td>' . $v['durata_media'] . '</td>';
    echo '<td>' . $v['luogo'] . '</td>';
    echo '</tr>';
}
echo '</tbody></table>
      </div>
    </div>
  </div>';

echo '</div>'; // close accordion
echo '</div>'; // close container

if(isset($_POST['modifica_Id_guida']))
    header('Location: ./dashboard_modifica.php');

if(isset($_POST['modifica_Id_evento']))
    header('Location: ./dashboard_modifica.php');

if(isset($_POST['modifica_titolo_visita']))
    header('Location: ./dashboard_modifica.php');
?>

<div class="container my-4">
    <h3><strong>Inserisci</strong></h3>
    <hr>

    <div class="accordion" id="insertAccordion">

        <!-- INSERIMENTO EVENTO-->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingForm1">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseForm1"
                        aria-expanded="true" aria-controls="collapseForm1">
                    Evento
                </button>
            </h2>
            <div id="collapseForm1" class="accordion-collapse collapse" aria-labelledby="headingForm1">
                <div class="accordion-body">
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
                </div>
            </div>
        </div>

        <!-- INSERIMENTO GUIDA-->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingForm2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseForm2" aria-expanded="false" aria-controls="collapseForm2">
                    Guida
                </button>
            </h2>
            <div id="collapseForm2" class="accordion-collapse collapse" aria-labelledby="headingForm2">
                <div class="accordion-body">
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
                </div>
            </div>
        </div>

        <!-- INSERIMENTO VISITA -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingForm3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseForm3" aria-expanded="false" aria-controls="collapseForm3">
                    Visita
                </button>
            </h2>
            <div id="collapseForm3" class="accordion-collapse collapse" aria-labelledby="headingForm3">
                <div class="accordion-body">
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
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container my-4">
    <h3><strong>Modifica</strong></h3>
    <hr>

    <div class="accordion" id="insertAccordion">

        <!-- MODIFICA EVENTO-->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFormA">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFormA"
                        aria-expanded="true" aria-controls="collapseFormA">
                    Evento
                </button>
            </h2>
            <div id="collapseFormA" class="accordion-collapse collapse" aria-labelledby="headingFormA">
                <div class="accordion-body">
                    <form action="dashboard_modifica.php" method="post">
                        <label for="modifica_Id_evento"><strong>Id evento</strong></label>
                        <input type="number" id="modifica_Id_evento" name="modifica_Id_evento" required>
                        <hr>

                        <div class="submit-container">
                            <input type="submit" value="Vai alla modifica dell'evento">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODIFICA GUIDA-->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFormB">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFormB" aria-expanded="false" aria-controls="collapseFormB">
                    Guida
                </button>
            </h2>
            <div id="collapseFormB" class="accordion-collapse collapse" aria-labelledby="headingFormB">
                <div class="accordion-body">
                    <form action="dashboard_modifica.php" method="post">
                        <label for="modifica_Id_guida"><strong>Id guida</strong></label>
                        <input type="number" id="modifica_Id_guida" name="modifica_Id_guida" required>
                        <hr>

                        <div class="submit-container">
                            <input type="submit" value="Vai alla modifica della guida">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODIFICA VISITA -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFormC">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFormC" aria-expanded="false" aria-controls="collapseFormC">
                    Visita
                </button>
            </h2>
            <div id="collapseFormC" class="accordion-collapse collapse" aria-labelledby="headingFormC">
                <div class="accordion-body">
                    <form action="dashboard_modifica.php" method="post">
                        <label for="modifica_titolo_visita"><strong>Titolo visita</strong></label>
                        <input type="text" id="modifica_titolo_visita" name="modifica_titolo_visita" required>
                        <hr>

                        <div class="submit-container">
                            <input type="submit" value="Vai alla modifica della visita">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php ob_end_flush();
require '../references/footer.php'; ?>
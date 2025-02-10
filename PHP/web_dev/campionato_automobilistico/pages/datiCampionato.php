<?php
$title = 'Classifica case';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

require '../references/navbar.php';

$queryReadCase = 'select * from db_campionato_automobilistico.case_automobilistiche';
$queryReadPiloti = 'select * from db_campionato_automobilistico.piloti';
$queryReadGare = 'select * from db_campionato_automobilistico.gare';
$queryReadGareggiare = 'select * from db_campionato_automobilistico.gareggiare';
$queryReadPartecipare = 'select * from db_campionato_automobilistico.partecipare';

?>
    <div style="margin-top: 2%; margin-bottom: 2%">
        <h2  class="entità">CASE</h2>
        <table>
            <thead> <!-- contiene le intestazioni-->
            <tr>
                <th class="col">Nome</th>
                <th class="col">Colore</th>
            </tr>
            </thead>
            <tbody>

            <?php
            try {
                $stm = $db->prepare($queryReadCase);
                $stm->execute();
                while ($casa = $stm->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $casa->nome . "</td>";
                    echo '<td>' . $casa->colore . "</td>";
                    echo '</tr>';
                }
                $stm->closeCursor();
            } catch (Exception $e) {
                logError($e);
            }
            ?>
            </tbody>
        </table>

        <h2 style="margin-top: 4%"  class="entità">PILOTI</h2>
        <table>
            <thead> <!-- contiene le intestazioni-->
            <tr>
                <th class="col">Id</th>
                <th class="col">Nome</th>
                <th class="col">Cognome</th>
                <th class="col">Nazionalita</th>
                <th class="col">Casa di appartenenza</th>
                <th class="col">Vittorie pilota</th>
            </tr>
            </thead>
            <tbody>

            <?php
            try {
                $stm = $db->prepare($queryReadPiloti);
                $stm->execute();
                while ($pilota = $stm->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $pilota->numero . "</td>";
                    echo '<td>' . $pilota->nome . "</td>";
                    echo '<td>' . $pilota->cognome . "</td>";
                    echo '<td>' . $pilota->nazionalita . "</td>";
                    echo '<td>' . $pilota->nome_casa . "</td>";
                    echo '<td>' . $pilota->vittorie . "</td>";
                    echo '</tr>';
                }
                $stm->closeCursor();
            } catch (Exception $e) {
                logError($e);
            }
            ?>
            </tbody>
        </table>

        <h2 style="margin-top: 4%"  class="entità">GARE</h2>
        <table>
            <thead> <!-- contiene le intestazioni-->
            <tr>
                <th class="col">Data</th>
                <th class="col">Luogo</th>
                <th class="col">Giro migliore</th>
            </tr>
            </thead>
            <tbody>

            <?php
            try {
                $stm = $db->prepare($queryReadGare);
                $stm->execute();
                while ($gara = $stm->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $gara->data . "</td>";
                    echo '<td>' . $gara->luogo . "</td>";
                    echo '<td>' . $gara->tempo_veloce . "</td>";
                    echo '</tr>';
                }
                $stm->closeCursor();
            } catch (Exception $e) {
                logError($e);
            }
            ?>
            </tbody>
        </table>

        <h2 style="margin-top: 4%" class="relazione">GAREGGIARE</h2>
        <table>
            <thead> <!-- contiene le intestazioni-->
            <tr>
                <th class="col">Id pilota</th>
                <th class="col">Data</th>
                <th class="col">Luogo</th>
                <th class="col">Tempo</th>
            </tr>
            </thead>
            <tbody>

            <?php
            try {
                $stm = $db->prepare($queryReadGareggiare);
                $stm->execute();
                while ($gareggiare = $stm->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $gareggiare->id_pilota . "</td>";
                    echo '<td>' . $gareggiare->data_gara . "</td>";
                    echo '<td>' . $gareggiare->luogo_gara . "</td>";
                    echo '<td>' . $gareggiare->tempo . "</td>";
                    echo '</tr>';
                }
                $stm->closeCursor();
            } catch (Exception $e) {
                logError($e);
            }
            ?>
            </tbody>
        </table>

        <h2 style="margin-top: 4%"  class="relazione">PARTECIPARE</h2>
        <table>
            <thead> <!-- contiene le intestazioni-->
            <tr>
                <th class="col">Nome casa</th>
                <th class="col">Data</th>
                <th class="col">Luogo</th>
            </tr>
            </thead>
            <tbody>

            <?php
            try {
                $stm = $db->prepare($queryReadPartecipare);
                $stm->execute();
                while ($partecipare = $stm->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $partecipare->nome_casa . "</td>";
                    echo '<td>' . $partecipare->data_gara . "</td>";
                    echo '<td>' . $partecipare->luogo_gara . "</td>";
                    echo '</tr>';
                }
                $stm->closeCursor();
            } catch (Exception $e) {
                logError($e);
            }
            ?>
            </tbody>
        </table>
    </div>
<?php
require '../references/footer.php';
?>
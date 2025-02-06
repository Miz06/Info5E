<?php
$title = 'Classifica case';

require './connectionToDB.php';
require './navbar.php';

$queryCase = 'select * from db_campionato_automobilistico.case';
$queryClassificaCase = 'select * from db_campionato_automobilistico.partecipare';

function logError(Exception $e): void
{
    error_log($e->getMessage(), 3, 'log/database_log');
    echo 'A DB error occurred, Try again';
}

?>
    <div style="margin-top: 2%; margin-bottom: 2%">
        <h2>CASE</h2>
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
                $stm = $db->prepare($queryCase);
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

        <h2 style="margin-top: 4%">CLASSIFICA CASE</h2>
        <table>
            <thead> <!-- contiene le intestazioni-->
            <tr>
                <th class="col">Nome casa</th>
                <th class="col">Luogo gara</th>
                <th class="col">Data gara</th>
            </tr>
            </thead>
            <tbody>

            <?php
            try {
                $stm = $db->prepare($queryClassificaCase);
                $stm->execute();
                while ($gara = $stm->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $gara->nome_casa . "</td>";
                    echo '<td>' . $gara->luogo_gara . "</td>";
                    echo '<td>' . $gara->data_gara . "</td>";
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
require './footer.php';
?>
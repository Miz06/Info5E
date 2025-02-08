<?php
$title = 'Classifiche gare';

require './connectionToDB.php';
require './navbar.php';

//query per visualizzare la classifica per ogni gara
$queryClassificaGare = 'select * 
from db_campionato_automobilistico.datiCampionato 
order by luogo_gara, tempo';

//query per visualizzare le vittorie di ogni casa
$queryClassificaCase = 'select d.nome_casa, d.colore_casa, sum(d.vittorie) as vittorie
from db_campionato_automobilistico.datiCampionato d
group by d.nome_casa';

function logError(Exception $e): void
{
    error_log($e->getMessage(), 3, 'log/database_log');
}

?>

    <div style="margin-top: 2%; margin-bottom: 2%">
        <h2 class="entità">CLASSIFICA GARE</h2>
        <?php
        try {
            $stm = $db->prepare($queryClassificaGare);
            $stm->execute();

            // array associativo (a ogni gara corrisponde una classifica)
            $gare = [];

            while ($gara = $stm->fetch(PDO::FETCH_ASSOC)) { //si itera per ogni tupla
                $chiavePrimaria = $gara['luogo_gara'] . ' - ' . $gara['data_gara']; //si identifica ogni gara tramite la sua gara primaria
                $gare[$chiavePrimaria][] = $gara; //i dati di ogni singola gara vengono associati alla chiave primaria corrispondente
                $miglior_tempo = $gara['tempo_veloce'];
            }

            $stm->closeCursor();

            //viene stampata la classifica per ogni gara
            foreach ($gare as $gara => $classifica) {
                echo "<h3 style='text-align: center'>Luogo e Data : $gara<br>Tempo migliore: $miglior_tempo<br></h3>";
                echo "<table><thead>
                    <tr>
                        <th class='col'>Id Pilota</th>
                        <th class='col'>Nome pilota</th>
                        <th class='col'>Cognome pilota</th>
                        <th class='col'>Casa</th>
                        <th class='col'>Tempo</th>
                        <th class='col'>Posizione</th>
                    </tr>
                  </thead>
                  <tbody>";

                $posizione = 1;

                //stampa delle posizione dei piloti della gara
                foreach ($classifica as $row) {
                    echo "<tr>
                        <td>{$row['numero']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['cognome']}</td>
                        <td>{$row['nome_casa']}</td>                        
                        <td>{$row['tempo']}</td>
                        <td>$posizione</td>
                      </tr>";
                    $posizione++; //serve a visualizzare anche la posizione dei piloti
                }
                echo "</tbody></table><br>";
            }
        } catch (Exception $e) {
            logError($e);
        }
        ?>

        <br>
        <h2 class="entità">CLASSIFICA CASE</h2>
        <table>
            <thead> <!-- contiene le intestazioni-->
            <tr>
                <th class="col">Casa</th>
                <th class="col">Colore</th>
                <th class="col">Vittorie</th>
            </tr>
            </thead>
            <tbody>

            <?php
            try {
                $stm = $db->prepare($queryClassificaCase);
                $stm->execute();
                while ($casa = $stm->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $casa->nome_casa . "</td>";
                    echo '<td>' . $casa->colore_casa . "</td>";
                    echo '<td>' . $casa->vittorie . "</td>";
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
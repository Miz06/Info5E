<?php
$title = 'Classifiche gare';

require './DBconn.php';
$config = require './databaseConfig.php';
$db = DBconn::getDB($config);

require './navbar.php';

//ogni volta viene eliminata e ricreata la tabella ottenuta dalle join in quanto questa non si aggiorna automaticamente all'aggiornarsi delle tabelle che la compongono
$queryDeleteJoin = 'drop table db_campionato_automobilistico.datiCampionato';
$queryCreateJoin = 'create table db_campionato_automobilistico.datiCampionato as
select 
	p.nome,
	p.cognome,
	p.nazionalita,
	p.numero,
	p.vittorie,
	p.nome_casa,
	c.colore as colore_casa,
	g.data_gara as data_gara,
	g.luogo_gara as luogo_gara,
	g.tempo as tempo,
	g1.tempo_veloce
from db_campionato_automobilistico.piloti p
join db_campionato_automobilistico.case_automobilistiche c on p.nome_casa = c.nome
join db_campionato_automobilistico.gareggiare g on p.numero = g.id_pilota
join db_campionato_automobilistico.gare g1 on g.luogo_gara = g1.luogo and g.data_gara = g1.data;';

try {
    $stm = $db->prepare($queryDeleteJoin);
    $stm->execute();
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

try {
    $stm = $db->prepare($queryCreateJoin);
    $stm->execute();
    $stm->closeCursor();
} catch (Exception $e) {
    logError($e);
}

//query per visualizzare la classifica per ogni gara
$queryClassificaGare = 'select * 
from db_campionato_automobilistico.datiCampionato 
order by luogo_gara, tempo';

//query per visualizzare le vittorie di ogni casa
$queryClassificaCase = 'select d.nome_casa, d.colore_casa, sum(d.vittorie) as vittorie
from db_campionato_automobilistico.datiCampionato d
group by d.nome_casa 
order by sum(d.vittorie) desc';
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
                echo "<h3 style='text-align: center' class='data_ora_gara'>Luogo e Data : $gara<br>Tempo migliore: $miglior_tempo<br></h3>";
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
                <th class="col">Posizione</th>
            </tr>
            </thead>
            <tbody>

            <?php
            try {
                $stm = $db->prepare($queryClassificaCase);
                $stm->execute();

                $posizione = 1;

                while ($casa = $stm->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $casa->nome_casa . "</td>";
                    echo '<td>' . $casa->colore_casa . "</td>";
                    echo '<td>' . $casa->vittorie . "</td>";
                    echo '<td>' . $posizione . "</td>";
                    echo '</tr>';
                    $posizione++;
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
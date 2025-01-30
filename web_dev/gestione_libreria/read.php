<?php
$title = 'Read';

require './connection.php';
require './navbar.php';
require './footer.php';

$query = 'select * from table_libreria';
?>

<div class="card">
<h1>READ</h1>

<table>
    <thead> <!-- contiene le intestazioni-->
    <tr>
        <th class="col">Titolo</th>
        <th class="col">Autore</th>
        <th class="col">Genere</th>
        <th class="col">Prezzo</th>
        <th class="col">Anno pubblicazione</th>
    </tr>
    </thead>
    <tbody>

    <?php
    try {
        $stm = $db->prepare($query);
        $stm->execute();
        while ($libro = $stm->fetch()) {
            //stampare risultati
            echo '<tr>';
            echo '<td>' . $libro->titolo . "</td>";
            echo '<td>' . $libro->autore . "</td>";
            echo '<td>' . $libro->genere . "</td>";
            echo '<td>' . $libro->prezzo . "</td>";
            echo '<td>' . $libro->anno_pubblicazione . "</td>";
            echo '</tr>';
        }
        $stm->closeCursor();
    } catch (Exception $e) {
        logError($e);
    }

    function logError(Exception $e)
    {
        error_log($e->getMessage(), 3, 'log/database_log');
        echo 'A DB error occurred, Try again';
    }

    ?>
    </tbody>
</table>
</div>



<?php

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryReadSovrani = 'select * from db_utopia.sovrani';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<style></style>
<body>
<div style="margin-top: 2%; margin-bottom: 2%">
    <h2>SOVRANI</h2>
    <table>
        <thead> <!-- contiene le intestazioni-->
        <tr>
            <th class="col">NOME</th>
            <th class="col">IMMAGINE (LINK)</th>
            <th class="col">INIZIO REGNO</th>
            <th class="col">FINE REGNO</th>
            <th class="col">SUCCESSORE</th>
            <th class="col">PREDECESSORE</th>
        </tr>
        </thead>
        <tbody>

        <?php
        try {
            $stm = $db->prepare($queryReadSovrani);
            $stm->execute();
            while ($sovrano = $stm->fetch()) {
                echo '<tr>';
                echo '<td>' . $sovrano->nome . "</td>";
                echo '<td>' . $sovrano->immagine . "</td>";
                echo '<td>' . $sovrano->inizio_regno . "</td>";
                echo '<td>' . $sovrano->fine_regno . "</td>";
                echo '<td>' . $sovrano->successore . "</td>";
                echo '<td>' . $sovrano->predecessore . "</td>";
                echo '</tr>';
            }
            $stm->closeCursor();
        } catch (Exception $e) {
            logError($e);
        }
        ?>
        </tbody>
    </table>

    <a href="./form.php">Inserimento sovrani</a>
</div>
</body>
</html>
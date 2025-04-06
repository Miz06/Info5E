<?php
session_start();

if (isset($_SESSION['start_time'])) {
    $tempo_trascorso = time() - $_SESSION['start_time'];

    if ($tempo_trascorso <= 60) {

        $citta = require_once './citta.php'; //uso require once per evitare conflitti nell'assegnazione dei valori nel corso del file seguente

//assegnazione valori
        foreach ($citta as $c => $value) {
            if (isset($_POST[$c . '_voto'])) {
                $citta[$c] = $_POST[$c . '_voto'];
            }
        }

        arsort($citta); //si basa sui valori, non sulle chiavi

//stampa
        echo '<table>';
        echo '<tr><th>Città</th><th>Voto</th><br>';
        foreach ($citta as $c => $value) {
            echo '<tr>';
            echo '<td>' . $c . '</td>';
            echo '<td>' . $citta[$c] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        session_destroy();
        echo '<a href="index1.php">Sessione scaduta. Clicca per tornare al form</a>';
    }
}

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
        th, td {
            padding: 1%;
            text-align: center;
            border: 1px solid black;
        }

        th {
            background-color: lightblue;
        }

        table {
            margin: 20px auto;
            width: 80%;
            border-collapse: collapse; /* per fondere i bordi delle celle vicine */
        }

        a {
            padding: 1%;
            text-align: center;
            background-color: #6a1b9a;
            color: white;
            border: 1px solid black;
        }

    </style>
</head>
<body>

</body>
</html>

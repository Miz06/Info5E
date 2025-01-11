<?php
//$_POST //array associativo(key, value)
//var_dump($_POST);
$domande = [
    'Qual\'è la funzione principale di un DBMS?',
    'Quale dei seguenti è un tipo di DBMS?',
    'Quale linguaggio viene comunemente utilizzato per interrogare i database relazionali?',
    'Quale delle seguenti operazioni NON è tipicamente supportata da un DBMS?',
    'Quale di questi è un esempio di un DBMS?',
];

$i = 0;

$q1 = $_POST['q1'] ?? ''; /* Per evitare di riscontrare errori */
$q2 = $_POST['q2'] ?? '';
$q3 = $_POST['q3'] ?? [];
$q4 = $_POST['q4'] ?? '';
$q5 = $_POST['q5'] ?? [];

$corrette = [
    'Entrambi i precedenti',
    'SQL',
    'Python',
    'C#',
    'Stampa dei documenti',
    'MySQL',
];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .card {
        background-color: white;
        padding: 2%;
        margin-left: 25%;
        margin-right: 25%;
        margin-top: 2%;
        margin-bottom: 2%;
        border: 1px solid #b8b8b8;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        position: relative; /* Necessario per il posizionamento dell'elemento con position absolute */
    }

    .card-with-bar::before {
        content: ''; /* specifica che l'elemento è vuoto */
        position: absolute; /* per far comportare l'elemento rispetto all'elemento con position relatiove */
        top: 0; /*allinea l'elemento in alto*/
        left: 0; /*allinea l'elemento a sinistra*/
        right: 0; /*allinea l'elemento a destra*/
        height: 10%; /*Altezza della parte colorata*/
        background-color: blueviolet;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
</style>
<body>
<div class="card card-with-bar">
    <h1>Test sui DBMS</h1>
</div>

<?php foreach ($domande as $domanda): ?>
    <div class="card">
        <?php
        echo '<strong>' . htmlspecialchars($domanda) . '</strong> <br>';

        // Determina quale risposta mostrare in base all'indice
        switch ($i) {
            case 0:
                $risposte = $q1;
                break;
            case 1:
                $risposte = $q2;
                break;
            case 2:
                $risposte = $q3;
                break;
            case 3:
                $risposte = $q4;
                break;
            case 4:
                $risposte = $q5;
                break;
            default:
                $risposte = '';
        }

        if (is_array($risposte)) {
            echo 'Risposte date: <br>';
            foreach ($risposte as $risposta)
                if (in_array($risposta, $corrette)) {
                    echo '~ ' . htmlspecialchars($risposta) . ' ✓<br>';
                } else {
                    echo '~ ' . htmlspecialchars($risposta) . ' ✗<br>';
                }
        } else {
            if ($i == 0) {
                $str = strtolower($risposte);
                $parole = str_word_count($risposte);
                $consonanti = 0;
                $vocali = 0;
                $numeri = 0;
                $v = ['a', 'e', 'i', 'o', 'u'];

                for ($j = 0; $j < strlen($str); $j++)
                    if (ctype_digit($str[$i])) {
                        $numeri++;
                    } elseif (in_array($str[$i], $v)) {
                        $vocali++;
                    } elseif (ctype_alpha($str[$i])) {
                        $consonanti++;
                    }

                echo 'Numero parole: ' . $parole . '<br>';
                echo 'Numero vocali: ' . $vocali . '<br>';
                echo 'Numero consonanti: ' . $consonanti . '<br>';
                echo 'Numero caratteri numerici: ' . $numeri . '<br>';
                echo 'Risposta data: <br>' . htmlspecialchars($risposte) . '<br>';

            } else {
                echo 'Risposta data: <br>';
                if (in_array($risposte, $corrette)) {
                    echo '~ ' . htmlspecialchars($risposte) . ' ✓<br>';
                } else {
                    echo '~ ' . htmlspecialchars($risposte) . ' ✗<br>';
                }
            }
        }

        $i++;

        ?>
    </div>
<?php endforeach; ?>
</body>
</html>
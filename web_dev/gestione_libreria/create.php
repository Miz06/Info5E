<?php
$domande = [
    'Qual\'è la funzione principale di un DBMS?',
    'Quale dei seguenti è un tipo di DBMS?',
    'Quale linguaggio viene comunemente utilizzato per interrogare i database relazionali?',
    'Quale delle seguenti operazioni NON è tipicamente supportata da un DBMS?',
    'Quale di questi è un esempio di un DBMS?',
];

$opzioniD2 = [
    'Relazionale',
    'Non relazionale',
    'Entrambi i precedenti',
    'Nessuno dei precedenti',
];

$opzioniD3 = [
    'HTML',
    'SQL',
    'Python',
    'C#',
];

$opzioniD4 = [
    'Creazione di tabelle',
    'Stampa dei documenti',
    'Backup dei dati',
];

$opzioniD5 = [
    'Microsoft Word',
    'MySQL',
    'Adobe Photoshop',
    'Google Chrome',
];

$i = 0; /* utilizzato per la scrittura in php della domanda corrente*/
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
    <style>
        body {
            background-color: #f7d7ff;
            font-family: Arial, sans-serif;
        }

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
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        textarea, .inputStyle {
            width: 100%;
            resize: vertical; /* Permette di ridimensionare solo verticalmente */
            margin-top: 10px;
            border: none;
            background-color: white;
        }

        textarea:focus, .inputStyle:focus {
            outline: none; /* Rimuove il contorno predefinito */
        }

        .submit-button {
            background-color: blueviolet;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 3% auto;
        }

        .submit-button:hover {
            background-color: #6a1b9a;
        }

    </style>
</head>
<body>
<?=require './reference/navbar.php';?>
<form method="post" action="pagina2.php">
    <div class="card card-with-bar">
        <h1 style="padding-top: 5%">Test sui DBMS</h1>

        <br>
        <label for="name"><strong>Nome</strong></label>
        <textarea id="name" name="name" rows="1" placeholder="..." required></textarea> <!-- required viene utilizzato per rendere il campo obbligatorio -->
        <hr>

        <br>
        <label for="surname"><strong>Cognome</strong></label>
        <textarea id="surname" name="surname" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="email"><strong>Email</strong></label>
        <br>
        <input type="email" id="email" name="email" placeholder="..." required class="inputStyle"></input>
        <hr>

        <br>
        <label for="pwd"><strong>Password</strong></label>
        <br>
        <input type="password" id="pwd" name="pwd" placeholder="..." required class="inputStyle">
        <hr>
    </div>

    <!--    --><?php //foreach ($domande as $domanda):?>
    <!--        <div class="card">-->
    <!--            --><?php //echo htmlspecialchars($domanda);?>
    <!--        </div>-->
    <!--    --><?php //endforeach;?>

    <div class="card">
        <?php
        echo '<label for="q1"> <strong>' . htmlspecialchars($domande[$i]) . '</strong></label>';
        $i++;
        ?>
        <br>
        <textarea id="q1" name="q1" rows="5" cols="40" placeholder="La tua risposta..."></textarea>
    </div>

    <div class="card">
        <?php
        echo '<label for="q2"> <strong>' . htmlspecialchars($domande[$i]) . ' </strong>';
        $i++ . '</label>';
        foreach ($opzioniD2 as $opzioneD2) {
            echo '<br> <input type="radio" id="q2" name="q2" value="' . htmlspecialchars($opzioneD2) . '">' . htmlspecialchars($opzioneD2);
        }
        ?>
    </div>

    <div class="card">
        <?php
        echo '<label for="q3"> <strong>' . htmlspecialchars($domande[$i]) . ' </strong>';
        $i++ . '</label>';
        foreach ($opzioniD3 as $opzioneD3) {
            echo '<br> <input type="checkbox" id="q3" name="q3[]" value="' . htmlspecialchars($opzioneD3) . '">' . htmlspecialchars($opzioneD3);
        }
        ?>
    </div>

    <div class="card">
        <?php
        echo '<label for="q4"> <strong>' . htmlspecialchars($domande[$i]) . ' </strong>';
        $i++ . '</label>';
        echo '<br> <select id="q4" name="q4">';
        foreach ($opzioniD4 as $opzioneD4) {
            echo '<option value="' . htmlspecialchars($opzioneD4) . '">' . htmlspecialchars($opzioneD4) . '</option>';
        }
        echo '</select>';
        ?>
    </div>

    <div class="card">
        <?php
        echo '<label for="q5"> <strong>' . htmlspecialchars($domande[$i]) . ' </strong>';
        $i++ . '</label>';
        echo '<br> <select id="q5" name="q5[]" size="4" multiple>';
        foreach ($opzioniD5 as $opzioneD5) {
            echo '<option value="' . htmlspecialchars($opzioneD5) . '">' . htmlspecialchars($opzioneD5) . '</option>';
        }
        echo '</select>';
        ?>
    </div>

    <input type="submit" class="submit-button" value="Invia"> <!-- Invia il form a pagina2.php -->
</form>
<?=require './reference/footer.php';?>
</body>
</html>

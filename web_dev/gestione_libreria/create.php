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
    <link rel="stylesheet" href="./style.css">
    <title>Test</title>
    <style>
        .card {
            background-color: white;
            padding: 2%;
            margin-left: 20%;
            margin-right: 20%;
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

        form {
            margin-bottom: 20%;
        }
    </style>
</head>
<body>
<?php require './navbar.php'; ?>

<form method="post" action="pagina2.php">
    <div class="card card-with-bar">
        <h1 style="padding-top: 5%">CREATE - Aggiungi nuovo libro</h1>

        <br>
        <label for="titolo"><strong>Titolo</strong></label>
        <textarea id="titolo" name="titolo" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="Autore"><strong>Autore</strong></label>
        <textarea id="Autore" name="Autore" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="Genere"><strong>Genere</strong></label>
        <textarea id="Autore" name="Autore" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="Prezzo"><strong>Prezzo</strong></label>
        <textarea id="Prezzo" name="Prezzo" rows="1" placeholder="..." required></textarea>
        <hr>
    </div>

    <input type="submit" class="submit-button" value="Crea"> <!-- Invia il form a pagina2.php -->
</form>

<?php require './footer.php'; ?>
</body>
</html>

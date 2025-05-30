<?php
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
<body>
<p>Inserimento studente</p>
<form action="action.php" method="POST">
    <label>Codice fiscale: <input type="text" name="cf" required></label><br><br>
    <label>Nome: <input type="text" name="nome" required></label><br><br>
    <label>Cognome: <input type="text" name="cognome" required></label><br><br>
    <label>Data di Nascita: <input type="date" name="dataDiNascita" required></label><br><br>
    <label>Residenza: <input type="text" name="residenza"></label><br><br>
    <label>Telefono: <input type="text" name="telefono"></label><br><br>
    <label>Matricola: <input type="text" name="matricola"></label><br><br>
    <label>Indirizzo: <input type="text" name="indirizzo"></label><br><br>
    <label>Media: <input type="number" step="0.5" min="1" max="10" name="media"></label><br><br>
    <button type="submit">Inserisci</button>
</form>
</body>
</html>
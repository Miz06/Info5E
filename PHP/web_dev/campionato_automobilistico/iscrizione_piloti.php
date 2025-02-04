<?php
$title = 'Iscrizione piloti';

require './navbar.php';
?>

<form method="post" action="iscrizione_piloti.php">
    <div class="card">
        <h1>Dati pilota</h1>

        <br>
        <label for="nome_pilota"><strong>Nome</strong></label>
        <textarea id="nome_pilota" name="nome_pilota" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="cognome_pilota"><strong>Cognome</strong></label>
        <textarea id="cognome_pilota" name="cognome_pilota" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="nazionalita_pilota"><strong>Nazionalità</strong></label>
        <textarea id="nazionalita_pilota" name="nazionalita_pilota" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="tempo_pilota"><strong>Tempo</strong></label>
        <textarea id="tempo_pilota" name="tempo_pilota" rows="1" placeholder="..." required></textarea>
        <hr>

    </div>

    <br>

    <div class="card">
        <h1>Dati casa</h1>

        <br>
        <label for="nome_casa"><strong>Nome</strong></label>
        <textarea id="nome_casa" name="nome_casa" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="colore_casa"><strong>Colore</strong></label>
        <textarea id="colore_casa" name="colore_casa" rows="1" placeholder="..." required></textarea>
        <hr>
    </div>

    <input type="submit" class="submit-button" value="ISCRIVI">
</form>

<?php require './footer.php';
?>

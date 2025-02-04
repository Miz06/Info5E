<?php
$title = 'Iscrizione piloti';

require './navbar.php';
?>

<form method="post" action="iscrizione_piloti.php">
    <div class="card">
        <h1><?= $title ?></h1>

        <br>
        <label for="nome_pilota"><strong>Nome pilota</strong></label>
        <textarea id="nome_pilota" name="nome_pilota" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="cognome_pilota"><strong>Cognome pilota</strong></label>
        <textarea id="cognome_pilota" name="cognome_pilota" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="nazionalita_pilota"><strong>Nazionalità pilota</strong></label>
        <textarea id="nazionalita_pilota" name="nazionalita_pilota" rows="1" placeholder="..." required></textarea>
        <hr>

        <br>
        <label for="tempo_pilota"><strong>Tempo pilota</strong></label>
        <textarea id="tempo_pilota" name="tempo_pilota" rows="1" placeholder="..." required></textarea>
        <hr>
    </div>

    <input type="submit" class="submit-button" value="ISCRIVI">
</form>

<?php require './footer.php';
?>

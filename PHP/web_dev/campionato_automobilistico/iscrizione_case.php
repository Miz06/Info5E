<?php
$title = 'Iscrizione case';

require './navbar.php';
?>

<form method="post" action="iscrizione_case.php">
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

    <input type="submit" class="submit-button" value="ISCRIVI CASA">
</form>

<?php require './footer.php';
?>

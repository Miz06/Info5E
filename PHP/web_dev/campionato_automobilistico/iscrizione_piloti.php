<?php
$title = 'Iscrizione piloti';
$case=[
        "ciao",
        "lello",
];
require './connectionToDB.php';
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
        <label for="casa_pilota"><strong>Casa</strong></label>
        <br>
        <?php
            foreach($case as $casa){
                echo "<br><input type='radio' id='casa_pilota' name='casa_pilota' value='$casa'> $casa";
            }
        ?>
        <hr>

    </div>
    <input type="submit" class="submit-button" value="ISCRIVI PILOTA">
</form>

<?php require './footer.php';
?>

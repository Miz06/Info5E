<?php
$title = 'home';
require '../references/navbar.php';
?>

<div class="element">
    <h4>Informazioni relative alla gestione del plico</h4>
    <hr>
    <h6>1) Il cliente consegna il pacco in sede [data e ora registrate]</h6>
    <h6>2) Un membro del personale registra e immagazzina il plico </h6>
    <h6>3) Il plico viene spedito da un membro del personale in un altra sede [data e ora registrate]</h6>
    <h6>4) Il plico è recapitato da un membro del personale </h6>
    <h6>5) Il destinatario ritira il plico [data e ora registrate]</h6>
</div>

<div class="element">
    <form method="post" action="home.php">
        <h4>Contattaci</h4>
        <hr>

        <br>
        <label for="nome_email_info"><strong>Il tuo nome</strong></label>
        <input type="text" name="nome_email_info" id="nome_email_info" required>

        <br><br>
        <label for="email_info"><strong>La tua email</strong></label>
        <input type="text" name="email_info" id="email_info" required>

        <br><br>
        <label for="quesito"><strong>Quesito</strong></label>
        <input type="text" name="quesito" id="quesito" required>

        <div class="submit-container">
            <input type="submit" value="Invia email al team Fast Route">
        </div>
    </form>
</div>

<?php require '../references/footer.php';?>

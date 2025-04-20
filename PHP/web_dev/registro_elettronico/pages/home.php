<?php

$title = 'home';
require '../references/navbar.php';
?>

    <div class="container">
        <h4>Effettua l'accesso come:</h4><br>
        <a class="login-button" href="studente.php">Studente</a><hr><br>
        <a class="login-button" href="genitore.php">Genitore</a><hr><br>
        <a class="login-button" href="insegnante.php">Insegnante</a><hr><br>
        <a class="login-button" href="amministratore.php">Amministratore</a><hr>
    </div>

<?php
require '../references/footer.php';
?>


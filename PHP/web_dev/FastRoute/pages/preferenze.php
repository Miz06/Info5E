<?php

$title = 'preferenze';
require '../references/navbar.php';

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (isset($_POST['nav_color']) && $_SESSION['email'] != 'Ospite') {
        setcookie('user', $_SESSION['email']);
        setcookie('nav_color', $_POST['nav_color']);
    }
    header("Location: account.php"); // Reindirizzamento
}
?>

<form method="post" action="preferenze.php">
    <br>
    <label><strong>Colore navbar</strong></label>

    <br>
    <input type='radio' id='verde' name='nav_color' value='#28a745'>
    <label for="verde">Verde</label>

    <br>
    <input type='radio' id='blu' name='nav_color' value='#007bff'>
    <label for="blu">Blu</label>

    <br>
    <input type='radio' id='viola' name='nav_color' value='#6f42c1'>
    <label for="viola">Viola</label>

    <br>
    <input type='radio' id='nero' name='nav_color' value='#000000'>
    <label for="nero">Nero</label>

    <br><br>
    <input type="submit" href="./account.php" value="Salva preferenze">
    <hr>
</form>


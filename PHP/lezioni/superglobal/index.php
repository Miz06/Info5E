<?php
require './action_page.php';
if(isset($_COOKIE['user'])){
    $name = $_COOKIE['user'];
}else{
    $name = 'undefined user';
}

/*  variabili SUPERGLOBAL (variabili predefinite dal linguaggio php visualizzabili e utilizzabili da tutti gli script)
 * $_SERVER
 * $_GET (per ottenere dati dal server; fa vedere tutti i valori passati IN CHIARO nell'url della paina; VIENE UTILIZZATO DI DEFAULT SE POST NON è SPECIFICATO)
 * $_POST (per inviare dati al server)
 * $_COOKIE (
 * informazione testuale che il server da al client il quale la slva nella memoria locale permanente e lo utilizza ogni volta che tenta la connessione al server;
 * viene salvato nella memoria del client in quanto il protocollo http non ha memoria e salvare informazioni sul server lo appesantisce;
 * contiene le preferenze dell'utente;
 * )
 * $_SESSION
 * */

/*
 * cookie = tante coppie [key - value]
 * What is a Cookie? [W3SCHOOL]
A cookie is often used to identify a user. A cookie is a small file that the server embeds on the user's computer.
Each time the same computer requests a page with a browser, it will send the cookie too.
With PHP, you can both create and retrieve cookie values.*/

/*
var_dump($_SERVER);
echo '<br>' . '<br>';
echo $_SERVER['REQUEST_METHOD']. '<br>' . '<br>';
echo $_SERVER['SERVER_PROTOCOL']. '<br>' . '<br>';
*/
?>

<h1>Ciao: <?=$name?></h1>
<form action="action_page.php" method="GET">
    <label for="fname">First name:</label><br>
    <input type="text" name="fname" id="fname"><br><br>

    <label for="color">Color:</label><br>
    <input type="text" name="color" id="color"><br><br>

    <label for="pwd">Password:</label><br>
    <input type="pwd" name="pwd" id="pwd"><br><br>
    <input type="submit" value="Submit">
</form>
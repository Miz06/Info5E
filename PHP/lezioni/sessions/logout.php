<?php
session_start();
$_SESSION=[];
session_destroy(); //elimini la sessione
setcookie(session_name(), '', time() - 3600, '/', '', false, false); //fai scadere la sessione con un valore negativo
echo 'logged out';
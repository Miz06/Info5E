<?php
session_start();

$_SESSION = [];
session_destroy();

setcookie('nome', '', time() - 3600, '/');
setcookie('cognome', '', time() - 3600, '/');
setcookie('username', '', time() - 3600, '/');

header("Location: ../pages/home.php");
?>
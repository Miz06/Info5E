<?php
session_start();

//elimino sessione
$_SESSION = [];
session_destroy();

//elimino cookies
if (isset($_COOKIE['nome'])) {
    setcookie('nome', '', time() - 3600);
}

if (isset($_COOKIE['email'])) {
    setcookie('email', '', time() - 3600);
}

if (isset($_COOKIE['nav_color'])) {
    setcookie('nav_color', '', time() - 3600);
}

header('location: home.php');
<?php
session_start();
setcookie('nome', $_SESSION['nome'], time() + 3600);
setcookie('email', $_SESSION['email'], time() + 3600);
setcookie('nav_color', $_SESSION['nav_color'], time() + 3600);
header('Location: ./account.php');
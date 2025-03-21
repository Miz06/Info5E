<?php

session_start();
$_SESSION['email'] = 'Ospite';
setcookie('nav_color', 'black');
header('location: home.php');
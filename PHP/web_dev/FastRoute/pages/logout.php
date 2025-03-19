<?php

session_start();
$_SESSION['email'] = 'Ospite';
header('location: home.php');
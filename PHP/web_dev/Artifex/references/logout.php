<?php
session_start();

$_SESSION = [];
session_destroy();
setcookie(session_name(), '', time() - 3600, '/');

setcookie('email', '', time()-3600, '/');
setcookie('nome', '', time()-3600, '/');

header('Location: ../pages/account.php');
exit();
<?php

setcookie('user', $_GET['fname']);
setcookie('color', $_GET['color']);

echo 'Nome: '.$_GET['fname'].'<br>';
echo 'Color: '.$_GET['color'].'<br>';
echo 'Password: '.$_GET['pwd'].'<br>';
?>

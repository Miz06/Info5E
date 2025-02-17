<?php

setcookie('user', $_GET['color']);
setcookie('user', $_GET['fname']);
//setcookie('user',$_GET['fname'],'','','',true,true);

$color = $_GET['color'];
echo $_GET['fname'];
echo $_GET['pwd'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background-color: <?=$color?>">

</body>
</html>

<?php

session_start();

if($_SERVER['REQUESTO_METHOD'] = 'POST' && isset($_POST['name'])){
    $_SESSION['name'] = $_POST['name'];
    header('Location: ./page2.php');
}

if(isset($_COOKIE['name'])){
    echo $_COOKIE['name'];
}

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
<body>
    <form action="page1.php" method="post">
        <label for="name">Nome</label>
        <input type="text" id="name" name="name" required>

        <input type="submit" value="submit">
    </form>
</body>
</html>




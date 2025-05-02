<?php

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$password = '123';
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO db_artifex.amministratori (email, password) VALUES (:email, :password)";
$stm = $db->prepare($query);
$stm->bindValue(':email', 'admin1@gmail.com');
$stm->bindValue(':password', $hashedPassword);
$stm->execute();
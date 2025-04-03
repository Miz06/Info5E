<?php

require './navbar.php';
$config = require './connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryInsertUser = "INSERT INTO users (nome, email, password) values (:nome, :email, :password)";
$queryInsertAdmin = "INSERT INTO admins (nome, email, password) values (:nome, :email, :password)";

$users = [
  "a@gmail.com" => ["nome" => "Alessandro", "password" => "Password1!"],
  "b@gmail.com" => ["nome" => "Benedetta", "password" => "Password2!"],
  "c@gmail.com" => ["nome" => "Cristiano", "password" => "Password3!"],
];

$admins = [
    "admin1@gmail.com" => ["nome" => "Admin1", "password" => "Password11!"],
    "admin2@gmail.com" => ["nome" => "Admin2", "password" => "Password22!"],
];

foreach($users as $email=>$user){
    try{
        $hashedPassword = password_hash($user["password"], PASSWORD_DEFAULT);
        $stm=$db->prepare($queryInsertUser);
        $stm->bindValue(":nome", $user["nome"]);
        $stm->bindValue(":email", $email);
        $stm->bindValue(":password", $hashedPassword);
        $stm->execute();
        $stm->closeCursor();
    }catch(Exception $e){
        logError($e);
    }
}

foreach($admins as $email=>$admin){
    try{
        $hashedPassword = password_hash($admin["password"], PASSWORD_DEFAULT);
        $stm=$db->prepare($queryInsertAdmin);
        $stm->bindValue(":nome", $admin["nome"]);
        $stm->bindValue(":email", $email);
        $stm->bindValue(":password", $hashedPassword);
        $stm->execute();
        $stm->closeCursor();
    }catch(Exception $e){
        logError($e);
    }
}



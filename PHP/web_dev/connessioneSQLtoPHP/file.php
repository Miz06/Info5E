<?php
require 'DBconn.php';
$config = require 'databaseConfig.php';
//$db= new PDO($config['dns'], $config['username'], $config['password'], $config['options']);
$db = DBconn::getDB($config);
//var_dump($db);
//echo $db-> getAttribute(PDO::ATTR_DRIVER_NAME);

//---------------------------------------------------------------------
//CREATE

//$query = 'insert into studenti(matricola_studente,nome,cognome,media,data_iscrizione) values(:matricola_studente,:nome,:cognome,:media,NOW())';

/*try {
    $stm = $db->prepare($query);
    $stm->bindValue(':matricola_studente', '00010');
    $stm->bindValue(':nome', 'Lucy');
    $stm->bindValue(':cognome', 'Taylor');
    $stm->bindValue(':media', '8');
    if ($stm->execute()) {
        $stm->closeCursor();
    } else {
        throw new PDOException("Errore nella query");
    }
}catch(Exception $e){
    logError($e);
}
function logError(Exception $e){
    error_log($e->getMessage(),3,'log/database_log');
    echo'A DB error occurred, Try again';
}*/

//---------------------------------------------------------------------
//READ
/*
$query='select * from studenti';
try{
    $stm=$db->prepare($query);
    $stm->execute();
    while($studente=$stm->fetch()){
        echo"Nome: ".$studente->nome."<br>";
        echo"Cognome: ".$studente->cognome."<br>";
        echo"Media: ".$studente->media."<br>";
        echo"Data Iscrizione: ".$studente->data_iscrizione."<br>";
        echo"Matricola: ".$studente->matricola_studente."<hr>";
    }
    $stm->closeCursor();
}catch(Exception $e){
//echo $e->getMessage();
    logError($e);
}
*/

/*$query='select media,cognome from studenti where nome=:name';
try{
    $stm=$db->prepare($query);
    $stm->bindValue(':name','Antonella');
    $stm->execute();
    while($studente=$stm->fetch()){

        echo"Cognome: ".$studente->cognome."<br>";
        echo"Media: ".$studente->media."<hr>";

    }
    $stm->closeCursor();
}catch(Exception $e){
//echo $e->getMessage();
    logError($e);
}*/

//---------------------------------------------------------------------
//UPDATE

/*
try {
    $query = 'update studenti set media=:media where nome=:nome';
    $stm = $db->prepare($query);
    $stm->bindValue(':nome', 'Lucy');
    $stm->bindValue(':media', '9');
    if ($stm->execute()) {
        $stm->closeCursor();
    } else {
        throw new PDOException("Errore nella query");
    }
}catch(Exception $e){
    logError($e);
}
function logError(Exception $e){
    error_log($e->getMessage(),3,'log/database_log');
    echo'A DB error occurred, Try again';
}*/

//---------------------------------------------------------------------
//DELETE

$query = 'DELETE FROM studenti WHERE nome=:nome';

try {
    $stm = $db->prepare($query);
    $stm->bindValue(':nome', 'Lucy');
    if ($stm->execute()) {
        $stm->closeCursor();
    } else {
        throw new PDOException("Errore nella query");
    }
}catch(Exception $e){
    logError($e);
}
function logError(Exception $e){
    error_log($e->getMessage(),3,'log/database_log');
    echo'A DB error occurred, Try again';
}

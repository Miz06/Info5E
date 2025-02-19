<?php

return [
    'dns'=>'mysql:host=localhost;dbname=db_dinastia_sovrani',
    'username'=>'root',
    'password'=>'',
    'options'=>[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
];
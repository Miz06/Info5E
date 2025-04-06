<?php

$pwd = "Password1!";
echo $pwd . '<br>';

$hashed = password_hash($pwd, PASSWORD_DEFAULT);
echo $hashed . '<br>';

if(password_verify($pwd, $hashed)){
    echo 'è presente corrispondenza';
}else{
    echo 'no corrispondenza';
}

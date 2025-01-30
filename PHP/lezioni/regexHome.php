<?php

//1
$subject = 'infowdjnwk34';
$pattern = '#info*[0-9]*[a-zA-Z]#';

if(preg_match($pattern, $subject)){
    echo 'matched'.'<br>';
}
else{
    echo 'not matched'.'<br>';
}

//2
$subject = 'djnwk34atica';
$pattern = '#[0-9]*[a-zA-Z]*atica#';

if(preg_match($pattern, $subject)){
    echo 'matched'.'<br>';
}
else{
    echo 'not matched'.'<br>';
}

//3
$subject = 'aXYZ4';
$pattern = '#[aeiou]XYZ[0-5]#i'; //i per rendere il tutto case insensitive

if(preg_match($pattern, $subject)){
    echo 'matched'.'<br>';
}
else{
    echo 'not matched'.'<br>';
}

//4
$subject = 'http://www.iisviolamarchesini.edu.it/parolaparola :: 45465';
$pattern = '#http://www\.iisviolamarchesini\.edu\.it/[a-zA-Z]* :: *[0-9]#';

if(preg_match($pattern, $subject)){
    echo 'matched'.'<br>';
}
else{
    echo 'not matched'.'<br>';
}

//5
$subject = 'home/index/6754.php';
$pattern = '#home/index/[0-9]*\.php#';

if(preg_match($pattern, $subject)){
    echo 'matched'.'<br>';
}
else{
    echo 'not matched'.'<br>';
}

//6
$subject = '/home/index/products/percorso/percorso';
$pattern = '#(/[a-zA-Z]+){2,4}#';

if(preg_match($pattern, $subject)){
    echo 'matched'.'<br>';
}
else{
    echo 'not matched'.'<br>';
}

//7
//Cosa fa questa regex?
$subject = 'localhost/percorso/percorso.php';
$pattern='#localhost(/[A-Za-z]+){2,4}.php#';

if(preg_match($pattern, $subject)){
    echo 'matched'.'<br>';
}
else{
    echo 'not matched'.'<br>';
}

//consente di controllare se una stringa ha una struttura del tipo: localhost + da 2 a 4 blocchi di /percorso + che la stringa termini con php
//da sottolineare il fatto che . senza \ davanti esprime tutti i caratteri forchè quello di a capo mentre \. indica il punto come carattere vero e proprio
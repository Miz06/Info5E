<?php
//echo phpinfo();


/**************************************/


$names = [
    'Bob',
    'John',
    'Jim',
    'Alice',
];


/*
echo $names[0];
echo '<br>';
*/


//l'elemento viene aggiunto alla fine dell'array che si comporta come una lista
$names[] = 'Antony';


for($i=0; $i<count($names); $i++)
    echo $names[$i].'<br>';


echo '<br>';


//anlizza l'array
var_dump($names);


//rimuovere un elemento dall'array ma non trasla tutti gli altri...
unset($names[1]);


echo '<br>';
echo '<br>';


//anlizza l'array
var_dump($names);


echo '<br>';
echo '<br>';


//non utilizzabile sempre in quanto potrebbe non considerare l'ultimo elemento nel caso in cui uno sia stato rimosso
for($i=0; $i<count($names); $i++)
    if(isset($names[$i]))
        echo $names[$i].'<br>';


echo '<br>';
echo '<br>';


//più adatto alla stampa dell'array senza dover effettuare controlli sugli elementi
//inoltre non presenta problemi di lunghezza dell'array
foreach($names as $name)
    echo $name.'<br>';


echo '<br>';
echo '<br>';


//consente di eliminare il buco creato da unset() ma è sempre meglio stampare utilizzando
//foreach in quanto più compatto
$names = array_values($names);


for($i=0; $i<count($names); $i++)
    echo $names[$i].'<br>';


echo '<br>';
echo '<br>';


//associative array (array associativi)
//key/value
$studenti = [
    'Alice' => 8,
    'Bob' => 7,
    'Lucy' => 9,
];


echo $studenti['Alice'];


echo '<br>';
echo '<br>';


foreach($studenti as $key => $value)
    echo $key.' - '.$value.'<br>';


//************************
//DATE TIME
//legacy tymestamp, date, time, mktime, getdate, strtotime
//prior to php  2024


echo '<br>';
echo '<br>';


$now = new DateTime();
echo $now->format('Y-m-d H:i:s');




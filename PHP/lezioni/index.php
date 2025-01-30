<?php
echo 'hello world';
$myvar = 'ciao';
echo '<br>';
echo $myvar;
echo '<br>';
$myvar = 2;
echo $myvar;
echo '<br>';
//php è un linguaggio debolmente tipizzato (LOOSE TYPING)

//DATI
// integer - double - boolean - string - double with scientific notation
$integer = 10;
$double = 10.5;
$boolean = true;
$string = 'Bob';
$dwsn = 3.5e-12; //rappresentazione in virgola mobile

echo PHP_INT_MAX; //massimo numero intero
echo '<br>';
echo PHP_INT_MIN; //massimo numero intero
const PIGRECO = '3.151516'; //const
echo '<br>';
echo PIGRECO;

$a=0;
$b='0';

echo '<br>';
if($a===$b) //identity operator == conversion
    echo 'sono uguali';
else
    echo 'sono diversi';

echo '<br>';
if(null==false)
    echo 'sono uguali';
else
    echo 'sono diversi';

echo '<br>';
if(isset($mySecondvar)) //per capire se una variabile è settata o meno (ovvero se è stata dichiarata)
    echo 'mySecondvar is set';
else
    echo 'mySecondvar is not set';

echo '<br>';
$mySecondvar = null; //SE UNA VARIABILE HA VALORE NULL VUOL DIRE CHE LA VARIABILE NON è SETTATA
if(is_null($mySecondvar)) //per capire se una variabile ha valore null o meno
    echo 'mySecondvar is null';
else
    echo 'mySecondvar is null';

echo '<br>';
$myThirdVar = 0; //guarda la funzione empy per vedere i valori considerati empty o meno
if(empty($myThirdVar))
    echo 'myThirdVr is empty';
else
    echo 'myThirdVar is not empty';

//ISTRUZIONI
//statements: iteration structures: (while - do while - for loops - break and continue)
//statements: selections structures: (if, if-else, switch, match, coalescing - spaceship)

//match
echo '<br>';
$grade = 'J';
$message = match($grade){
    'A' =>  'letter A',
    'B' =>  'letter B',
    'C', 'D' =>  'letter B',
    default => 'other letters',
};
echo $message;

echo '<br>';
$subtotal = 250;
$total = 0;
$message = match(true){
    $subtotal<=200 => $total = $subtotal*0.9,
    $subtotal>200 => $total = $subtotal*0.8,
};
echo $total;

//conditional operator
echo '<br>';
$num1 = 100;
$num2 = 200;
$num1>$num2 ? $r='ok' : $r='ko';
echo $r.'<br>';

//coalescing operator
$num0 = null;
$num3 = $num0 ?? $num2; //se num0 ha valore diverso da null allora num prende il suo valore, altrimenti prende quello di num2 a patto che anche questo abbia valore diverso da null
echo $num3.'<br>';

//spaceship operator
echo $num1<=>$num2; //confronto tra due numeri (che il primo sia minore, maggiore o uguale)
echo '<br>';

//STRINGS
$language = 'PHP';
$message = 'welcome to $language';
echo $message;
echo '<br>';

//STRINGS
$message = 'PHP';
$message = "welcome to $language"; //interpolazione
echo $message;
echo '<br>';

$count = 12;
$item = 'flower';
$message3 = "you have $count $item";
echo $message3;

echo '<br>';
$count = 12;
$item = 'flower';
$message3 = "you have $count {$item}s";
echo $message3;




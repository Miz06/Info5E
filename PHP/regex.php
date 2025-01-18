<?php
$pattern = '#abc#'; //ciò che bisogna ricercare
$subject = 'ciao'; //dove si deve ricercare


$pattern = '#^abc#'; //^ per indicare che la parola INIZI per quella stringa (occhio agli spazi prima delle stringhe)
$subject = 'ciabco';


$pattern = '#abc$#'; //^ per indicare che la parola FINISCA per quella stringa (occhio agli spazi dopo delle stringhe)
$subject = 'ciabc';


$pattern = '#a[123]b]#'; //numero tra 1 e 3 in mezzo alla stringa
$subject = 'a2232323232b';
$subject = 'ab';


$pattern = '#a[123]*b]#'; //* per avere da 0 a "infiniti" caratteri
$subject = 'a2b';


$pattern = '#a[0-9]+b#'; //+ per avere da 1 a "infiniti" caratteri
$subject = '4t5';


$pattern = '#4[a-zA-Z]*5#'; //per cercare lettere dalla a alla z in minuscolo e minuscolo
$subject = '4aBc5';


$pattern = '#home/index/[a-z]+#';
$subject = 'home/index/product';
$subject = '/home/index/temp/itis/venerdì/sesto';
$subject = '/animale/cane/gatto';
$subject = 'home/index/product';
$subject = '/home/index/temp/itis/venerdi/sesto';




$pattern = '#(/[a-z]+){1,5}#'; //intende da 1 a 5 blocchi di /stringa dalla a alla z in minuscolo
if (preg_match($pattern, $subject, $matches)) {
   echo 'match<br>';
   $result = explode('//', $matches[0]);
   echo count($result);
   echo '<br>';
   var_dump($result);
   echo '<br>';
   var_dump($matches); //stampa il valore della stringa subject
} else {
   echo 'not match';
}

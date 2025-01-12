<?php
require_once 'disciplina.php';
require_once 'percorso.php';

$percorso1 = new percorso('percorso1', 'argomento1', 12);
$percorso2 = new percorso('percorso2', 'argomento2', 5);
$percorso3 = new percorso('percorso3', 'argomento3', 2);
$percorso4 = new percorso('percorso4', 'argomento4', 8);


$percorso5 = new percorso('percorso5', 'argomento5', 1);
$percorso6 = new percorso('percorso6', 'argomento6', 9);
$percorso7 = new percorso('percorso7', 'argomento7', 3);
$percorso8 = new percorso('percorso8', 'argomento8', 6);

$percorso9 = new percorso('percorso9', 'argomento9', 4);
$percorso10 = new percorso('percorso10', 'argomento10', 8);
$percorso11 = new percorso('percorso11', 'argomento11', 2);
$percorso12 = new percorso('percorso12', 'argomento12', 1);

$array1 = [
    $percorso1,
    $percorso2,
    $percorso3,
    $percorso4,
];

$array2 = [
    $percorso5,
    $percorso6,
    $percorso7,
    $percorso8,
];

$array3 = [
    $percorso9,
    $percorso10,
    $percorso11,
    $percorso12,
];

$disciplina1 = new Disciplina('INFORMATICA', $array1);
$disciplina2 = new Disciplina('SISTEMI', $array2 );
$disciplina3 = new Disciplina('TPSIT', $array3 );

echo $disciplina1->getNome() . '<br>';
echo $percorso1->getPercorso();

?>
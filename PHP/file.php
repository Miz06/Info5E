<?php
echo getcwd(); //current directory
echo '<br>';


echo DIRECTORY_SEPARATOR;
echo '<br>';


//is_file - is_dir
$path = getcwd();
echo is_file($path.DIRECTORY_SEPARATOR.'prova.txt') ? 'trovato' : 'non trovato';
echo '<br>';


echo is_dir($path.DIRECTORY_SEPARATOR.'mydir') ? 'trovato' : 'non trovato';
echo '<br>';


//scandir
$items = scandir($path.DIRECTORY_SEPARATOR.'mydir');
echo '<h2> Files in myDir </h2>';
echo '<ul>';
foreach ($items as $item)
    if(str_starts_with($item, 'f'))
        echo '<li>'.$item.'</li>';
echo '</ul>';


//file_get_content: do not recognize rows
$text = file_get_contents($path.DIRECTORY_SEPARATOR.'prova.txt');
echo '<div>'.$text.'</div>';
echo '<br>';


//file: recognize rows
$rows = file ($path.DIRECTORY_SEPARATOR.'prova.txt');
foreach ($rows as $row)
    echo '<div>'.$row.'</div>';
echo '<br>';


//file_put_contents: overwrite content into the file
$text ='ciao ciao, scrivo ancora';
file_put_contents($path.DIRECTORY_SEPARATOR.'prova.txt', $text);


$subjects = [
    'informatica',
    'tpsit',
    'sistemi e reti',
];


$names = implode("\n", $subjects);
$text = file_put_contents($path.DIRECTORY_SEPARATOR.'prova.txt', $names, FILE_APPEND);


//copy - rename - unlink - feof()
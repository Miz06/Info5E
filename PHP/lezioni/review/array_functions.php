<?php

$array = [
    'item1' => [
        'it1' => ['type' => '1']
    ],
    'item2' => [
        'it1' => ['type' => '2']
    ],
    'item3' => [
        'it1' => ['type' => '3']
    ],
    'item4' => [
        'it1' => ['type' => '4']
    ],
];

echo $array['item1']['it1']['type'].'<br>';
$array['item5'] = [
    'it1' => ['type'=>'9']
];

echo $array['item5']['it1']['type'].'<br>';


echo '----------------------------'.'<br>';

foreach($array as $key=>$value){
    echo $value['it1']['type'].'<br>';
}
echo '----------------------------'.'<br>';

$keys = array_keys($array); //estrazione chiavi

for($i=0; $i<count($keys); $i++){
    echo $keys[$i].'<br>';
    echo $array[$keys[$i]]['it1']['type'].'<br>'.'<br>';
}
echo '----------------------------'.'<br>';

/*
sort($array);

$keys = array_keys($array); //estrazione chiavi

for($i=0; $i<count($keys); $i++){
    echo $keys[$i].'<br>';
    echo $array[$keys[$i]]['it1']['type'].'<br>'.'<br>';
}
echo '----------------------------'.'<br>';
*/

$copy=[];
foreach($array as $key=>$value){
    $copy[$key]=$value;
}

foreach($copy as $key=>$value){
    echo $key.'<br>';
    echo $value['it1']['type'].'<br>';
}
echo '----------------------------'.'<br>';

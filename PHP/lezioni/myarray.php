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

//---------------------------------------------------------
echo '-----------------------------------';
echo '<br>';

// Create an array to demonstrate various functions
$array = [10, 20, 30, 40, 50];
$assoc_array = ['a' => 30, 'b' => 20, 'c' => 40];

// Example: range() - Creates an array containing a range of elements
$range_array = range(1, 10);
print_r($range_array);

// Example: array_fill() - Fills an array with a specific value
$filled_array = array_fill(0, 5, 'value');
print_r($filled_array);

// Example: array_pad() - Pads an array to the specified length with a value
$padded_array = array_pad($array, 10, 0);
print_r($padded_array);

// Example: array_merge() - Merges one or more arrays
$merged_array = array_merge($array, $range_array);
print_r($merged_array);

// Example: array_slice() - Extracts a portion of an array
$sliced_array = array_slice($array, 1, 3);
print_r($sliced_array);

// Example: array_pop() - Removes the last element from an array
$last_element = array_pop($array);
echo "Popped element: $last_element\n";
print_r($array);

// Example: array_shift() - Removes the first element from an array
$first_element = array_shift($array);
echo "Shifted element: $first_element\n";
print_r($array);

// Example: array_sum() - Calculates the sum of the values in an array
$array_sum = array_sum($array);
echo "Sum of array: $array_sum\n";

// Example: in_array() - Checks if a value exists in an array
$is_in_array = in_array(20, $array);
echo "Is 20 in array? " . ($is_in_array ? 'Yes' : 'No') . "\n";

// Example: array_search() - Searches an array for a value and returns the key
$search_key = array_search(30, $array);
echo "Key of value 30: $search_key\n";

// Example: array_count_values() - Counts all the values of an array
$value_counts = array_count_values($range_array);
print_r($value_counts);

// Example: sort() - Sorts an array in ascending order
sort($array);
print_r($array);

// Example: rsort() - Sorts an array in descending order
rsort($array);
print_r($array);

// Example: asort() - Sorts an associative array in ascending order, maintaining key-value pairs
asort($assoc_array);
print_r($assoc_array);

// Example: arsort() - Sorts an associative array in descending order, maintaining key-value pairs
arsort($assoc_array);
print_r($assoc_array);

// Example: ksort() - Sorts an associative array by key in ascending order
ksort($assoc_array);
print_r($assoc_array);

// Example: krsort() - Sorts an associative array by key in descending order
krsort($assoc_array);
print_r($assoc_array);
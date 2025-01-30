<?php
echo '<br>';

//funzioni delle stringhe da provare:
/*
strlen()
substr()
substr_replace()
trim()
ltrim() rtrim()
stripslashes()
str_pad()
strpos()
strrpos()
stripos()
str_contains()
str_starts_with()
str_ends_with()
strToUpper()
strToLower()
ucfirst()
ucwords()
strrev()
str_shuffle()
str_repeat()
str_replace()
strcmp()
strcasecmp()
strnatcmp()
explode()
implode()
chr() - ord()
*/

//print the number of chars in the string
$stringa = 'Ciao';
echo(strlen($stringa));

echo '<br>';

//extracts a word from the string
echo(substr($stringa, 0, 3));

echo '<br>';

//substitute a part of the string with another string
echo substr_replace($stringa, "PHP", 1, 2); // Output: CPHo

echo '<br>';

//remove spaces at the beginning or at the end of the string
$stringa1 = ' Salve senatore ';
echo trim($stringa1);

echo '<br>';

//remove spaces only at the beginning of the string or only at the end
echo ltrim($stringa1);
echo rtrim($stringa1);

echo '<br>';

//removes backslashes from the string
$stringa2 = 'Backslashes removed \ \\ //';
echo stripslashes($stringa2);

echo '<br>';

//fill a string with chars until it reaches the specified length
echo str_pad($stringa2, 30, '*');

echo '<br>';

//find the position where the word is found in the string
echo strpos($stringa2, 'Backslashes');

echo '<br>';

//It works the same as strpos but case-insensitive
echo stripos($stringa2, 'backslashes');

echo '<br>';

//Say if the string contains a specified word
echo str_contains($stringa2, 'removed') ? "Yes" : "No";

echo '<br>';

//Check if the string starts with a specified word
echo str_starts_with($stringa2, 'Back') ? "Yes" : "No";

echo '<br>';

//Check if the string ends with a specified word
echo str_ends_with($stringa2, 'removed \\ //') ? "Yes" : "No";

echo '<br>';

//Convert string to uppercase
echo strtoupper($stringa);

echo '<br>';

//Convert string to lowercase
echo strtolower($stringa);

echo '<br>';

//Capitalize the first character of the string
echo ucfirst('ciao mondo');

echo '<br>';

//Capitalize the first character of every word
echo ucwords('ciao mondo');

echo '<br>';

//Reverse the string
echo strrev($stringa);

echo '<br>';

//Shuffle the string randomly
echo str_shuffle($stringa);

echo '<br>';

//Repeat a string multiple times
echo str_repeat('Hello ', 3);

echo '<br>';

//Replace parts of a string with another substring
echo str_replace('Hello', 'Hi', 'Hello World!');

echo '<br>';

//Compare two strings (case-sensitive)
echo strcmp('Ciao', 'ciao');

echo '<br>';

//Compare two strings (case-insensitive)
echo strcasecmp('Ciao', 'ciao');

echo '<br>';

//Compare two strings using natural order
echo strnatcmp('file2.txt', 'file10.txt');

echo '<br>';

//Split a string into an array based on a delimiter
$array = explode(',', 'apple,banana,orange');
print_r($array);

echo '<br>';

//Join an array into a string with a delimiter
echo implode(', ', $array);

echo '<br>';

//Get the ASCII character of a number
echo chr(65);

echo '<br>';

//Get the ASCII value of a character
echo ord('A');

echo '<br>';
<?php

function printValue(string|int $var): string
{//union type
    if (is_string($var)) {
        return "String: $var";
    } else {
        return "Number: $var";
    }
}

echo printValue(4) . '<br>';
echo printValue("Pepino il breve") . '<br>';

function def(string $name = "Luca"): string
{//default value
    return $name;
}

echo def('Alessandro');
echo def() . '<br>';

//value type
$a = 10;
$b = 20;
$c = 30;

echo $a . '<br>';

//ref type
$obj1 = (object)["value" => 10];
$obj2 = $obj1;
$obj2->value = 20;
echo $obj1->value . '<br>';

function len(?string $str): string //nullable parameter
{//str can be null
    if ($str != null) {
        return "Lunghezza stringa: " . strlen($str);
    } else {
        return "Stringa nulla";
    }
}

echo len("ciao") . '<br>';
echo len(null) . '<br>';

function sumAll(...$numbers): int//variadic function
{//accept a variable number of parameters
    return array_sum($numbers);
}

echo sumAll(10, 20) . '<br>';
echo sumAll(10, 20, 30) . '<br>';

function printHelloWorld(): string//variable function
{
    return "Hello World";
}

$func = "printHelloWorld";
echo $func() . '<br>';

function callB(string $f): string
{//callback function
    return $f();
}

echo callB($func) . '<br>';

$func1 = function ($string): string {//anonymous function
    return $string;
};

echo $func1("ciao") . '<br>';
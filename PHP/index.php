<?php

$url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
//echo $url;

echo '<br>';

$url = trim(str_replace('MVC5E', '', $url));

$routes = [
    'GET' => [
        'home/index' => ["controller" => "HomeController", "action" => "presentation1"],
        'home/products' => ["controller" => "ProductController", "action" => "show1"],
        'home/services' => ["controller" => "ServiceController", "action" => "presentation3"],
    ],
    'POST' => [
        'home/index' => ["controller" => "HomeController", "action" => "presentation11"],
        'home/products' => ["controller" => "ProductController", "action" => "show11"],
        'home/services' => ["controller" => "ServiceController", "action" => "presentation33"],
    ],
];
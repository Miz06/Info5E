<?php

$url = $_SERVER['REQUEST_URI']; //ricavo l'url CHE NON E' IL PERCORSO DEL FILE
$method = $_SERVER['REQUEST_METHOD']; //ricavo il metodo (GET)
/*
echo $url;

echo '<br><br>';
*/
$url = trim(str_replace('MVC5E', '', $url), '/'); //modifico l'url
/*
echo $url;
echo '<br><br>';
*/

 /*
$routes = [ //get (default) oppure post
    'GET' => [ //percorso mostrato
        'home/index' => ["controller" => "HomeController", "action" => "presentation1"], //CLASSE controller - METODO: action
        'home/products' => ["controller" => "ProductController", "action" => "show1"],
        'home/services' => ["controller" => "ServiceController", "action" => "presentation3"],
    ],
    'POST' => [
        'home/index' => ["controller" => "HomeController", "action" => "presentation11"],
        'home/products' => ["controller" => "ProductController", "action" => "show11"],
        'home/services' => ["controller" => "ServiceController", "action" => "presentation33"],
    ],
];
*/

/*
var_dump($routes[$method]);
echo '<br><br>';

var_dump($routes[$method][$url]);
echo '<br><br>';
*/

/*
//ottenimento nome classe utilizzata e metodo
$controller = $routes[$method][$url]['controller'];
echo 'Classe: ' .$controller;
echo '<br><br>';

$action = $routes[$method][$url]['action'];
echo 'Metodo: ' . $action;
echo '<br><br>';

require $controller.'.php';
$controllerObj = new $controller();//istanza un oggetto della classe controller
$controllerObj->$action(); //utilizzo del metodo della classe
*/

require 'Router/Router.php';
$routerClass = new \Router\Router();
$routerClass->AddRoute('GET', 'home/index', 'HomeController', 'presentation1');
$routerClass->AddRoute('GET', 'home/products', 'ProductsController', 'show1');
$routerClass->AddRoute('GET', 'home/services', 'ServicesController', 'presentation33');
$routerClass->AddRoute('POST', 'home/index', 'HomeController', 'presentation11');
$routerClass->AddRoute('POST', 'home/products', 'ProductsController', 'show11');
$routerClass->AddRoute('POST', 'home/services', 'ServicesController', 'presentation33');

/*
$routerClass->prova();
die();
*/

$reValue = $routerClass->match($url, $method);

if(empty($revalue)){
    http_response_code(404);
    die('Pagina non trovata');
}

$controller = 'App\Controller\\'.$reValue['controller'];
$action = $revalue['action'];

require $controller.'.php';
$controllerObj = new $controller();
$controllerObj->$action();

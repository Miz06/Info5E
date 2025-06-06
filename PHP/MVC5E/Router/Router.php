<?php

namespace Router;

class Router
{
    private array $routes = [];

    public function addRoute($method, $url, $controller, $action): void
    {
        $this->routes[$method][$url] = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    /*
    public function prova(){
        var_dump($this->routes);
    }
    */

    //metodo che mappa l'url e ritorna la classe in base a quest'ultimo
    public function match($url, $method)
    {
        $values = [];
        if(array_key_exists($url, $this->routes[$method])) {
            $values['controller'] = $this->routes[$method][$url]['controller'];
            $values['action'] = $this->routes[$method][$url]['action'];
        }
        return $values;
    }
}
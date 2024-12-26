<?php

namespace App;

use Exception;

class Router
{
    // Aqui e onde minhas rotas serao armazenadas
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method)
    {
        /* ['GET']['/users'] => [
            "controller" => HomeController,
            "action" => index()
        ]
        */
        $this->routes[$method][$route] = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function get($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "GET");
    }

    public function post($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "POST");
    }

    public function delete($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "DELETE");
    }

    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        if(array_key_exists($uri, $this->routes[$method])){
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];

            $requestTime = date('Y-m-d H:i:s');
            $responseStatus = 200;

            try {
                $controller = new $controller();
                $controller->$action();
            } catch (Exception $e){
                $responseStatus = 500;
                echo 'Error: ' . $e->getMessage();
            }

            

        } else {
            throw new Exception("No route found for URI: $uri");
        }
    }
}

?>

<?php

namespace App;

use App\Models\RequestApiLogs;
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

    private function controllerExists($controller, $action)
    {
        return !method_exists($controller, $action);
    }

    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        if(array_key_exists($uri, $this->routes[$method])){
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];
            
            if($this->controllerExists($controller, $action)){
                echo "O $controller::$action nao existe";
            }            

            $requestTime = date('Y-m-d H:i:s');
            $responseStatus = 200;

            try {
                $controller = new $controller();
                $controller->$action();
            } catch (Exception $e){
                $responseStatus = 500;
                echo 'Error: ' . $e->getMessage();
            }

            $logs = [
                "request_time" => $requestTime,
                "endpoint" => $uri,
                "request_method" => $method,
                "response_status" => $responseStatus,
                "ip_address" => $ipAddress
            ];

            (new RequestApiLogs)->registerLog($logs);        

        } else {
            $requestTime = date('Y-m-d H:i:s');
            $responseStatus = 404;
            $logs = [
                "request_time" => $requestTime,
                "endpoint" => $uri,
                "request_method" => $method,
                "response_status" => $responseStatus,
                "ip_address" => $ipAddress
            ];

            (new RequestApiLogs)->registerLog($logs);
            http_response_code($responseStatus);
            throw new Exception("No route found for URI: $uri");
        }
    }
}

?>

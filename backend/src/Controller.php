<?php

namespace App;

class Controller
{
    protected static function view($view, $data = [])
    {
        // Serve para extrair os dados que estao vindo no data
        extract($data);

        include "Views/$view.php";
    }

    protected function sendResponse($data, $statusCode = 200)
    {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');

        header("Access-Control-Allow-Methods: GET, POST");
        header("Access-Control-Allow-Headers: ContentType, Authorizations");

        http_response_code($statusCode);
        echo json_encode($data);
    }
}

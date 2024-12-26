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
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
    }
}

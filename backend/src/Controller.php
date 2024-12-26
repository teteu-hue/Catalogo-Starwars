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

    protected function sendResponse($data)
    {
        return json_encode($data, true);
    }
}

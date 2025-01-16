<?php

namespace App\Controllers;

use App\Controller;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function login()
    {
        // empty
        if (!(isset($_POST['email']) && isset($_POST['senha']))) {
            return $this->sendResponse(["data" => "email e senha não foram informados!"]);
        }
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (!(filter_var($email, FILTER_VALIDATE_EMAIL) && (strlen($email) >= 15 && strlen($email) <= 100))) {
            return $this->sendResponse(["error" => "O email informado não é válido!"], 400);
        }

        $response = (new AuthService)->validateUser($email, $senha);

        if (!$response) {
            return $this->sendResponse(["data" => "As credências informadas são inválidas!"], 400);
        }

        return $this->sendResponse(["data" => [
            "message" => "Login realizado com sucesso!",
            "token" => "token gerado!"
        ]]);
    }
}

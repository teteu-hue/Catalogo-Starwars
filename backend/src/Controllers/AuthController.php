<?php

namespace App\Controllers;

use App\Controller;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function login()
    {
        if(isset($_POST['email']) && isset($_POST['senha'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            if(filter_var($email, FILTER_VALIDATE_EMAIL) && (strlen($email) >= 15 && strlen($email) <= 100)){
                $response = (new AuthService)->validateUser($email, $senha);

                if(!$response){
                    return $this->sendResponse(["data" => "Email/Senha inválidos!"], 404);
                }

                return $this->sendResponse(["data" => [
                    "message" => "Login realizado com sucesso!",
                    "token" => "token gerado!"
                ]]);
            } else {
                return $this->sendResponse(["error" => "O email informado não é válido!"], 404);
            }
        }

    }
}

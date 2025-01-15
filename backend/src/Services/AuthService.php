<?php

namespace App\Services;

class AuthService
{
    public function validateUser($email, $senha)
    {
        $response = (new UserService)->getUser($email);
        $validatedPassword = $this->validatePassword($senha, $response['senha']);
        
        if($validatedPassword !== 0){
            return false;
        }

        return $response;
    }

    private function validatePassword(string $inputPassword, string $storedPassword)
    {
        return strcmp($inputPassword, $storedPassword);
    }
}

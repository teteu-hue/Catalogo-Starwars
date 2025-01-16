<?php

namespace App\Services;

class AuthService
{
    public function validateUser($email, $senha)
    {
        $user = (new UserService)->getUser($email);
        $validatedPassword = $this->validatePassword($senha, $user['senha']);
        
        if($validatedPassword !== 0){
            return false;
        }

        return $user;
    }

    private function validatePassword(string $inputPassword, string $storedPassword)
    {
        return strcmp($inputPassword, $storedPassword);
    }
}

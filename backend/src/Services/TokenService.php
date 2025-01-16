<?php

namespace App\Services;

use App\Models\Token;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenService
{

    public function generateToken(int $userId, string $email) : string
    {
        $payload = [
            "iss" => "client-front",
            "sub" => $userId,
            "email" => $email,
            "iat" => time()
        ];
        $token = JWT::encode($payload, bin2hex("helloWorld"), 'HS256');

        return $token;
    }

    public function decodeToken(string $token)
    {
        return JWT::decode($token, new Key(bin2hex("helloWorld"), 'HS256'));
    }
}
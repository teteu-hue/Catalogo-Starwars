<?php

namespace App\Models;

use App\Database\Dao;
use Exception;

"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjEsIm5hbWUiOiJKb2huIERvZSIsImlhdCI6
MTY4NjQ4MjUwMCwiZXhwIjoxNjg2NDg2MTAwfQ.XYZ123abc456def789ghi";

class Token extends Dao
{
    public function getToken(string $token)
    {
        $sql = "SELECT user_id, token, expire_at, created_at, revoked FROM token where token.token = :token";

        try {
            $token = $this->selectQuery($sql, [":token" => $token]);

            if(!$token){
                throw new Exception("Token is not found!");
            }
            return $token;
        } catch (Exception $e){
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }

    public function insertToken(int $userId, string $token, string $expireAt)
    {
        $sql = "INSERT INTO token(user_id, token, expire_at) 
                VALUES (:user_id, :token, :expire_at)";

        try {  
            $token = $this->insertQuery($sql, [
                ":user_id" => $userId,
                ":token" => $token,
                ":expire_at" => $expireAt
            ]);

            if(!$token){
                throw new Exception("Algo deu errado na criacao do token");
            }
            return $token;
        } catch (Exception $e){
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }

    public function revoked(string $token)
    {
        $sql = "UPDATE token SET revoked = 1 WHERE token.token = :token";

        try {
            $revoke = $this->updateQuery($sql, [":token" => $token]);

            if(!$revoke){
                throw new Exception("Revoked is get a error!");
            }

            return $revoke;
        } catch(Exception $e){
            error_log("Error: ". $e->getMessage());
            return false;
        }
    }
}


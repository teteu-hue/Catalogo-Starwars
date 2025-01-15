<?php

namespace App\Models;

use App\Database\Dao;
use PDOException;

class User extends Dao
{
    public function show($email)
    {
        $sql = "SELECT * FROM user where email = '$email'";

        try {
            return $this->selectQuery($sql);
        } catch (PDOException $e){
            error_log($e);
        }
    }

    public function create($data)
    {
        $sql = "INSERT INTO user(email, senha)
                VALUES(:email, :senha);";

        try {

            $body = [
                ":email" => $data['email'],
                ":senha" => $data['senha']
            ];

            $response = $this->insertQuery($sql, $body);

            if($response){
                return [
                    "message" => "Sucesso ao inserir os dados!"
                ];
            } else {
                return [
                    "error" => "Por favor, contate o suporte tecnico!"
                ];
            }

        } catch(PDOException $e){
            error_log($e->getMessage());
            return [
                "error" => "Por favor, contate o suporte tecnico"
            ];
        }
    }

}

<?php

namespace App\Models;

use App\Controller;
use App\Database\Dao;

class Character extends Dao
{
    public function index()
    {
        $sql = "SELECT * FROM characters;";

        return $this->selectQuery($sql);
    }

    public function create($data)
    {
        $sql = "INSERT INTO characters(name)
                VALUES (:name);";

        $params = [
            ":name" => $data['name']
        ];

        return $this->insertQuery($sql, $params);
    }
}

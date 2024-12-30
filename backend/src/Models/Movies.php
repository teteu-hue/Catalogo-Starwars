<?php

namespace App\Models;

use App\Database\Dao;
use PDOException;

class Movies extends Dao
{
    public function index()
    {
        $sql = "SELECT * FROM movies;";

        return $this->selectQuery($sql);
    }

    public function create($data)
    {
        $sql = "INSERT INTO movies(title, episode_id, opening_crawl, release_date, director, producers)
                VALUES (:title, :episode_id, :opening_crawl, :release_date, :director, :producer)";

        $body = [
            ":title" => $data['title'],
            ":episode_id" => $data['episode_id'],
            ":opening_crawl" => $data['opening_crawl'],
            ":release_date" => $data['release_date'],
            ":director" => $data['director'],
            ":producer" => $data['producer']
        ];

        $this->insertQuery($sql, $body);
    }
}

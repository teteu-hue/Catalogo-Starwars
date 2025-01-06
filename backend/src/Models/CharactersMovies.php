<?php

namespace App\Models;

use App\Database\Dao;

class CharactersMovies extends Dao
{
    public function index()
    {
        $sql = "SELECT * FROM characters_movies;";

        return $this->selectQuery($sql);
    }

    public function create($movieId, $characterId)
    {
        $sql = "INSERT INTO characters_movies(movie_id, character_id)
                VALUES (:movie_id, :character_id)";

        $params = [
            ":movie_id" => $movieId,
            ":character_id" => $characterId
        ];

        return $this->insertQuery($sql, $params);
        
    }
}
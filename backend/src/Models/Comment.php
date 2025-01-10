<?php

namespace App\Models;

use App\Database\Dao;
use Error;
use PDOException;

class Comment extends Dao
{
    public function show($id)
    {
        $sql = "SELECT movies.title, comments.comment, comments.created_at                  
                FROM comments 
                INNER JOIN movies ON movies.episode_id = comments.episode_id
                WHERE movies.episode_id = '$id'";
        try {
            return $this->selectQuery($sql);
        } catch(PDOException $e){
            echo "Error: ". $e->getMessage();
        }
    }

    public function create($data)
    {
        $sql = "INSERT INTO comments(episode_id, comment) VALUES(:episode_id, :comment);";

        try {
            return $this->insertQuery($sql, $data);
        } catch(PDOException $e){  
            return false;
        }
    }
}


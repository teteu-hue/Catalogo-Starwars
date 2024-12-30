<?php 

namespace App\Services;

use App\Resource\ApiStarWarsResource;

class MoviesService
{
    public static function getAll()
    {
        $response = ApiStarWarsService::get("https://swapi.py4e.com/api/films");
        $data = ApiStarWarsResource::formatResponse($response);
        return json_decode($data, true);
    }
}
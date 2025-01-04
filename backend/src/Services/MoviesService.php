<?php 

namespace App\Services;

use App\Resource\ApiStarWarsResource;

class MoviesService
{
    public static function getAll()
    {
        $response = ApiStarwarsService::get(BASE_URL . "films");
        $data = ApiStarWarsResource::formatResponse($response);
        return json_decode($data, true);
    }
}
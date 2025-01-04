<?php 

namespace App\Services;

use App\Resource\ApiStarWarsResource;
use App\Utils\Cache;

class MoviesService
{
    public static function getAll()
    {
        $endpoint = "films";

        $cachedMovies = Cache::getFromCache($endpoint);

        if($cachedMovies){
            return $cachedMovies;
        }

        $response = ApiStarwarsService::get(BASE_URL . "films");
        $formattedData = ApiStarWarsResource::formatResponse($response);

        $movies = json_decode($formattedData, true);

        Cache::saveToCache($endpoint, $movies, []);
        return $movies;
    }
}
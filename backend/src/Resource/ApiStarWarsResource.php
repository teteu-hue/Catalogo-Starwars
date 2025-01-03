<?php

namespace App\Resource;

use App\Models\Movies;
use App\Services\ApiStarwarsService;
use App\Services\CharacterService;

class ApiStarWarsResource
{

    private static function mountMovieResponse($data)
    {
        $response = json_decode($data, true);
        $body = [];

        for($i = 0; $i < count($response['results']); $i++){
            $body[$i]['title'] = $response['results'][$i]['title'];
            $body[$i]['episode_id'] = $response['results'][$i]['episode_id'];
            $body[$i]['opening_crawl'] = $response['results'][$i]['opening_crawl'];
            $body[$i]['director'] = $response['results'][$i]['director'];
            $body[$i]['producer'] = $response['results'][$i]['producer'];
            $body[$i]['release_date'] = $response['results'][$i]['release_date'];
            $body[$i]['characters'] = [];

            foreach($response['results'][$i]['characters'] as $character){
                $body[$i]['characters'][] = json_decode(ApiStarwarsService::get($character), true)['name'];
            }

            // Buscar um jeito de automatizar essa criacao dos resultados no banco de dados da aplicacao.
            //(new Movies)->create($body[$i]);
        }

        return json_encode($body);
    }

    public static function formatResponse($data): string
    {   
        return self::mountMovieResponse($data);
    }
}

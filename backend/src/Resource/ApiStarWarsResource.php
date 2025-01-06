<?php

namespace App\Resource;

use App\Models\CharactersMovies;
use App\Models\Movies;
use App\Services\ApiStarwarsService;
use App\Services\CharacterService;
use DateTime;

class ApiStarWarsResource
{

    private static function calculateMovieAge($releaseDate)
    {
        $releaseDate = new DateTime($releaseDate);

        $atualDate = new DateTime();

        $difference = $releaseDate->diff($atualDate);

        return [
            'anos' => $difference->y,
            'meses' => $difference->m + ($difference->y * 12),
            'dias' => $difference->days
        ];
    }

    private static function mountMovieResponse($data)
    {
        $response = json_decode($data, true);
        $body = [];

        for ($i = 0; $i < count($response['results']); $i++) {
            $body[$i]['title'] = $response['results'][$i]['title'];
            $body[$i]['episode_id'] = $response['results'][$i]['episode_id'];
            $body[$i]['opening_crawl'] = $response['results'][$i]['opening_crawl'];
            $body[$i]['director'] = $response['results'][$i]['director'];
            $body[$i]['producer'] = $response['results'][$i]['producer'];
            $body[$i]['release_date'] = $response['results'][$i]['release_date'];
            $body[$i]['characters'] = CharacterService::getCharactersInArray($response['results'][$i]['characters']);
            $body[$i]['film_age'] = self::calculateMovieAge($response['results'][$i]['release_date']);
            
            // Buscar um jeito de automatizar essa criacao dos resultados no banco de dados da aplicacao.
            //foreach($response['results'][$i]['characters'] as $character)
            //{
            //    (new CharactersMovies)->create($i, basename($character));
            //}
            //(new Movies)->create($body[$i]);
        }

        return json_encode($body);
    }

    public static function formatResponse($data): string
    {
        return self::mountMovieResponse($data);
    }
}

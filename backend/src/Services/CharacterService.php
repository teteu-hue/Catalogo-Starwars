<?php

namespace App\Services;

use App\Models\Character;

class CharacterService
{
    public static function get($page = false)
    {       
        if(!$page){
            $response = ApiStarWarsService::getPaginate(BASE_URL . "people");
        } else {
            $currentPage = 1;
            $hasMorePages = true;
            $body = [];
            while($hasMorePages){
                $response = ApiStarWarsService::getPaginate(BASE_URL . "people", $currentPage);
                
                foreach($response['results'] as $character){
                    $body[] = [
                        'name' => $character['name']
                    ];

                    //(new Character)->create(['name' => $character['name']]);
                }
                $currentPage++;
                $hasMorePages = !empty($response['next']);
            }

        }
        return $body;
    }    
}

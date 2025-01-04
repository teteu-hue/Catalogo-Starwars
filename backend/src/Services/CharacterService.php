<?php

namespace App\Services;

use App\Models\Character;

class CharacterService
{
    public static function getCharactersInArray($data)
    {       
        $body = [];
        
        foreach($data as $character){
            $response = ApiStarwarsService::get($character);
            $json = json_decode($response, true);
            $body[] = $json['name'];
        }
        return $body;
    }    
}

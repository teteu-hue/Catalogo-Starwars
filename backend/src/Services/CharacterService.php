<?php

namespace App\Services;

class CharacterService
{
    public static function get($page = null)
    {       
        if($page == null){
            $response = ApiStarWarsService::getPaginate(BASE_URL . "people");
        } else {
            $response = ApiStarWarsService::getPaginate( BASE_URL . "people", $page);
        }
        return json_decode($response, true);
    }    
}

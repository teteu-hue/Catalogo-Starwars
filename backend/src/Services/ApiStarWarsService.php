<?php

namespace App\Services;

use App\Resource\ApiStarWarsResource;
use Error;

class ApiStarWarsService
{
    public static function get($url)
    {
        $curl = curl_init();
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 500,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true
        ];

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        curl_close($curl);

        if (!$response) {
            throw new Error("Erro na API ". curl_error($curl));
        }

        return $response;  
    }

    public static function getCharacters($url)
    {
        $curl = curl_init();
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 500,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true
        ];

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        curl_close($curl);

        if (!$response) {
            throw new Error("Erro na API ". curl_error($curl));
        }

        $data = ApiStarWarsResource::mountCharacterResponse($response);

        return json_decode($data, true);
    }
}

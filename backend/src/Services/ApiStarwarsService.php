<?php

namespace App\Services;

use App\Resource\ApiStarWarsResource;
use Error;

class ApiStarwarsService
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

    public static function getPaginate($url, $page = null)
    {
        $curl = curl_init();
        if($page == null){
            $options = [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 500,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_FOLLOWLOCATION => true
            ];
        } else {
            $options = [
                CURLOPT_URL => $url . "?page=$page",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 500,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_FOLLOWLOCATION => true
            ];
        }
        

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        curl_close($curl);

        if (!$response) {
            throw new Error("Erro na API ". curl_error($curl));
        }

        return json_decode($response, true);
    }
}

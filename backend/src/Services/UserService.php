<?php

namespace App\Services;

use App\Models\User;
use Exception;

class UserService
{
    public function getUser($email)
    {
        try {
            $response = (new User)->show($email);
            if(!$response){
                return false;
            }
            return $response;
        } catch(Exception $e){
            error_log("Error: " . $e->getMessage());
        }
    }
}
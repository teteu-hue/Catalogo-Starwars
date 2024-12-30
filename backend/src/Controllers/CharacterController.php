<?php

namespace App\Controllers;

use App\Controller;
use App\Services\CharacterService;

class CharacterController extends Controller
{
    public function index()
    {
        return $this->sendResponse(CharacterService::get(2), 200);
    }
}
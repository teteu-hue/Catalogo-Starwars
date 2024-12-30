<?php

namespace App\Controllers;

use App\Controller;
use App\Services\ApiStarWars;

class MoviesController extends Controller
{
    public function index()
    {
        return $this->sendResponse(ApiStarWars::getMovies("https://swapi.py4e.com/api/films"), 200);
    }
}
<?php

namespace App\Controllers;

use App\Controller;
use App\Services\ApiStarWarsService;
use App\Services\MoviesService;

class MoviesController extends Controller
{
    public function index()
    {
        return $this->sendResponse(MoviesService::getAll(), 200);
    }
}
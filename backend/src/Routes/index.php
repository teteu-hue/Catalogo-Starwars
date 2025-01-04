<?php

use App\Controllers\CharacterController;
use App\Controllers\MoviesController;
use App\Router;

$route = new Router();

$route->get('/movies', MoviesController::class, 'index');
$route->get('/characters', CharacterController::class, 'index');

$route->dispatch();

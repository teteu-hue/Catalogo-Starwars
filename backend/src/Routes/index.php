<?php

use App\Controllers\HomeController;
use App\Controllers\MoviesController;
use App\Router;

$route = new Router();

$route->get('/', HomeController::class, 'index');
$route->get('/test', HomeController::class, 'test');
$route->get('/movies', MoviesController::class, 'index');

$route->dispatch();

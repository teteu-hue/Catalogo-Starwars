<?php

use App\Controllers\AuthController;
use App\Controllers\CharacterController;
use App\Controllers\CommentController;
use App\Controllers\MoviesController;
use App\Router;

$route = new Router();

$route->get('/movies', MoviesController::class, 'index');
$route->get('/characters', CharacterController::class, 'index');
$route->get('/comments', CommentController::class, 'getCommentsByEpisodeId');
$route->post('/comments', CommentController::class, 'store');

$route->post('/login', AuthController::class, 'login');

$route->dispatch();

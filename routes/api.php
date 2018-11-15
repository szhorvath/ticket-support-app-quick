<?php

use Zend\Diactoros\ResponseFactory;
use League\Route\Strategy\JsonStrategy;
use App\Middleware\Authenticate;
use App\Services\Auth\JwtAuth;

$router->group('/api', function ($router) use ($container) {
    $router->post('/auth/login', 'App\Controllers\Auth\LoginController::index');
    $router->get('/user', 'App\Controllers\UserController::index')->middleware(new Authenticate($container->get(JwtAuth::class)));
})->setStrategy((new JsonStrategy(new ResponseFactory))->setContainer($container));

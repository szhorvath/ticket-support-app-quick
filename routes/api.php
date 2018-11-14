<?php

use Zend\Diactoros\ResponseFactory;
use League\Route\Strategy\JsonStrategy;

$router->group('/api', function ($router) {
    $router->get('/json', 'App\Controllers\HomeController::json');
})->setStrategy(new JsonStrategy(new ResponseFactory));

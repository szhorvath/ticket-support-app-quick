<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = (new Dotenv\Dotenv(__DIR__))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

$container = new League\Container\Container;

$container->delegate(new League\Container\ReflectionContainer);
$container->addServiceProvider(new App\Providers\ConfigServiceProvider());

//Add service providers
foreach ($container->get('config')->get('providers') as $provider) {
    $container->addServiceProvider($provider);
}

$router = $container->get('router');

//Add middlewares
foreach ($container->get('config')->get('middleware') as $middleware) {
    $router->middleware($container->get($middleware));
}

//Routes
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../routes/api.php';


$response = $router->dispatch($container->get('request'));

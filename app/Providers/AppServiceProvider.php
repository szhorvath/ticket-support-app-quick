<?php

namespace App\Providers;

use League\Route\Router;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\ServiceProvider\AbstractServiceProvider;

class AppServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'router',
        'response',
        'request',
        'emitter'
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share('router', Router::class);

        $container->share('response', Response::class);

        $container->share('request', function () {
            return ServerRequestFactory::fromGlobals(
                $_SERVER,
                $_GET,
                $_POST,
                $_COOKIE,
                $_FILES
            );
        });

        $container->share('emitter', SapiEmitter::class);
    }
}

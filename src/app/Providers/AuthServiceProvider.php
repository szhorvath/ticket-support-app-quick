<?php

namespace App\Providers;

use PDO;
use App\Services\Auth\Parser;
use App\Services\Auth\Factory;
use App\Services\Auth\JwtAuth;
use App\Services\Auth\ClaimsFactory;
use App\Services\Auth\Providers\Jwt\FirebaseProvider;
use App\Services\Auth\Providers\Auth\DatabaseProvider;
use League\Container\ServiceProvider\AbstractServiceProvider;

class AuthServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        JwtAuth::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(JwtAuth::class, function () use ($container) {
            $config = $container->get('config');

            $authProvider = new DatabaseProvider($container->get(PDO::class));

            $claimsFactory = new ClaimsFactory(
                $container->get('request'),
                $config->get('jwt.expiry')
            );

            $jwtProvider = new FirebaseProvider($config->get('jwt.secret'));

            $factory = new Factory($claimsFactory, $jwtProvider);

            $parser = new Parser($jwtProvider);

            return new JwtAuth($authProvider, $factory, $parser);
        });
    }
}

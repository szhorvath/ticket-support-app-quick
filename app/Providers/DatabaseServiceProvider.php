<?php

namespace App\Providers;

use PDO;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use League\Container\ServiceProvider\AbstractServiceProvider;

class DatabaseServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        PDO::class,
    ];

    public function register()
    {
        $container = $this->getContainer();

        $config = $container->get('config');

        $container->share(PDO::class, function () use ($config) {
            return new PDO(
                $config->get('db.driver') . ':host=' . $config->get('db.host') . ';dbname=' . $config->get('db.name'),
                $config->get('db.user'),
                $config->get('db.password')
            );
        });
    }
}

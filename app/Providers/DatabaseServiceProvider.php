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

        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //make the default fetch be an associative array
        ];

        $container->share(PDO::class, function () use ($config, $options) {
            return new PDO(
                $config->get('db.driver') . ':host=' . $config->get('db.host') . ';dbname=' . $config->get('db.name'),
                $config->get('db.user'),
                $config->get('db.password'),
                $options
            );
        });
    }
}

<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Noodlehaus\Config;

class ConfigServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'config'
    ];

    public function register()
    {
        $this->getContainer()->share('config', function () {
            return new Config(__DIR__ . '/../../config');
        });
    }
}

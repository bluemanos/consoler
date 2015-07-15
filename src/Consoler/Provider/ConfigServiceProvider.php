<?php

namespace Consoler\Provider;

use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Consoler\Provider\Console\ConfigBag;

class ConfigServiceProvider implements ServiceProviderInterface
{
    /**
     * dir with end slash.
     */
    private $dir;

    public function __construct($dir)
    {
        $this->dir = rtrim($dir, '/').'/';
    }

    public function register(Container $container)
    {
        $dir = $this->dir;
        $container['config'] = function ($app) use ($dir) {
            return new ConfigBag($dir);
        };
    }
}

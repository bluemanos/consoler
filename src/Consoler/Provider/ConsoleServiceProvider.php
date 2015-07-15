<?php

/*
 * This file is part of the Consoler framework.
 *
 * (c) Szymon Bluma <szbluma@gmail.com>
 */

namespace Consoler\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Consoler\Provider\Console\ContainerAwareApplication;

/**
 * Consoler Console Service Provider.
 *
 * @author Szymon Bluma <szbluma@gmail.com>
 */
class ConsoleServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $pimple)
    {
        $pimple['console'] = function ($pimple) {
            $console = new ContainerAwareApplication($pimple['console.name'], $pimple['console.version']);
            $console->setDispatcher($pimple['dispatcher']);
            $console->setContainer($pimple);

            return $console;
        };
    }
}

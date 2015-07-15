<?php

/*
 * This file is part of the Consoler framework.
 *
 * (c) Szymon Bluma <szbluma@gmail.com>
 */

namespace Consoler\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Registers EventDispatcher and related services with the Pimple Container.
 *
 * @author Szymon Bluma <szbluma@gmail.com>
 *
 * @api
 */
class DispatcherServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Container $pimple)
    {
        $pimple['dispatcher'] = function () {
            return new EventDispatcher();
        };
    }
}

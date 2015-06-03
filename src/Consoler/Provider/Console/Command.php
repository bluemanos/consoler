<?php

/*
 * This file is part of the Consoler framework.
 *
 * (c) Szymon Bluma <szbluma@gmail.com>
 */

namespace Consoler\Provider\Console;

use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * Base class for Consoler commands.
 *
 * @author Szymon Bluma <szbluma@gmail.com>
 *
 * @api
 */
abstract class Command extends BaseCommand
{
    /**
     * Returns the application container.
     *
     * @return \Consoler\Application
     */
    public function getContainer()
    {
        return $this->getApplication()->getContainer();
    }

    /**
     * Returns a service contained in the application container or null if none
     * is found with that name.
     *
     * This is a convenience method used to retrieve an element from the
     * Application container without having to assign the results of the
     * getContainer() method in every call.
     *
     * @param string $name Name of the service
     *
     * @see self::getContainer()
     *
     * @api
     *
     * @return \stdClass|null
     */
    public function getService($name)
    {
        return $this->getApplication()->getService($name);
    }
}

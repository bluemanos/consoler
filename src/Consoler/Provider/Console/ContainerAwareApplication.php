<?php

/*
 * This file is part of the Consoler framework.
 *
 * (c) Szymon Bluma <szbluma@gmail.com>
 */

namespace Consoler\Provider\Console;

use Symfony\Component\Console\Application;

/**
 * Consoler Pimple Console Application.
 *
 * @author Szymon Bluma <szbluma@gmail.com>
 */
class ContainerAwareApplication extends Application
{
    private $pimple;

    /**
     * Constructor.
     *
     * @param string $name    The name of the application
     * @param string $version The version of the application
     */
    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);
    }

    /**
     * Sets a pimple instance onto this application.
     *
     * @param \Pimple\Container $pimple
     */
    public function setContainer(\Pimple\Container $pimple)
    {
        $this->pimple = $pimple;
    }

    /**
     * Get the Container.
     *
     * @return \Pimple\Container
     */
    public function getContainer()
    {
        return $this->pimple;
    }

    /**
     * Returns a service contained in the application pimple or null if none is found with that name.
     *
     * This is a convenience method used to retrieve an element from the Application pimple without having to assign
     * the results of the getContainer() method in every call.
     *
     * @param string $name Name of the service.
     *
     * @see self::getContainer()
     *
     * @api
     *
     * @return mixed|null
     */
    public function getService($name)
    {
        return $this->pimple[$name];
    }
}

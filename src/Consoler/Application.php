<?php

/*
 * This file is part of the Consoler framework.
 *
 * (c) Szymon Bluma <szbluma@gmail.com>
 */

namespace Consoler;

use Consoler\Provider\ConfigServiceProvider;
use Consoler\Provider\ConsoleServiceProvider;
use Consoler\Provider\DispatcherServiceProvider;
use Consoler\Provider\DoctrineServiceProvider;
use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * The Consoler framework class.
 *
 * @author Szymon Bluma <szbluma@gmail.com>
 *
 * @api
 */
class Application extends Container
{
    /**
     * @var ServiceProviderInterface[]
     */
    private $providers = [];

    /**
     * @var boolean
     */
    private $booted = false;

    /**
     * Registers the autoloader and necessary components.
     *
     * @param string      $name    Name for this application.
     * @param string|null $version Version number for this application.
     * @param array       $values
     */
    public function __construct($name, $version = null, array $values = [])
    {
        parent::__construct($values);

        $this->register(new DispatcherServiceProvider);
        $this->register(new ConsoleServiceProvider, [
            'console.name' => $name,
            'console.version' => $version,
        ]);
        $rootDir = getcwd();
        $this->register(new ConfigServiceProvider($rootDir.'/config'));
        $this->register(new DoctrineServiceProvider(), [
            'db.options' => include $rootDir.'/config/db.php',
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function register(ServiceProviderInterface $provider, array $values = [])
    {
        parent::register($provider, $values);

        $this->providers[] = $provider;
    }

    /**
     * Boots the Application by calling boot on every provider added and then subscribe
     * in order to add listeners.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->booted) {
            return;
        }

        $this->booted = true;
    }

    /**
     * Executes this application.
     *
     * @param InputInterface|null $input
     * @param OutputInterface|null $output
     * @return integer
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $this->boot();

        return $this['console']->run($input, $output);
    }

    /**
     * Adds a command object.
     *
     * If a command with the same name already exists, it will be overridden.
     *
     * @param Command $command A Command object
     * @api
     * @return void
     */
    public function command(Command $command)
    {
        $this['console']->add($command);
    }
}

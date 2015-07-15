<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;

class RootCommand extends Command
{
    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function database()
    {
        $db = $this->getApplication()->getService('db');

        return $db;
    }
}

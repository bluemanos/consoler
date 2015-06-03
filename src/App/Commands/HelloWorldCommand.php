<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class HelloWorldCommand extends Command
{
    protected function configure()
    {
        $this->setName('consoler:hello')
            ->setDescription('Basic command which only display single word :)')
            ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $text = 'Hello';
        if ($name) {
            $text .= ' '.$name;
        }
        if ($input->getOption('yell')) {
            $text = strtoupper($text);
        }
        $output->writeln($text);
    }
}

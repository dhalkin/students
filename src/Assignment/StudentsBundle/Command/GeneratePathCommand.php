<?php

namespace Assignment\StudentsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GeneratePathCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('student:generate:path')
            ->setDescription('Generate route by names of student');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {




        $output->writeln("olala");
    }
}

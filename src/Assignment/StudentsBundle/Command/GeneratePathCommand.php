<?php

namespace Assignment\StudentsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Assignment\StudentsBundle\Services\GeneratePathService;

/**
 * Class GeneratePathCommand
 * @package Assignment\StudentsBundle\Command
 */
class GeneratePathCommand extends ContainerAwareCommand
{

    /**
     * @var GeneratePathService
     */
    protected $generatePathService;

    /**
     * @param GeneratePathService $generatePathService
     */
    public function __construct(GeneratePathService $generatePathService)
    {
        $this->generatePathService = $generatePathService;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('student:generate:path')
            ->setDescription('Generate route by names of student');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $s = microtime(true);
        $this->generatePathService->generate();
        $e = microtime(true);

        $output->writeln("Time elapsed " . round($e - $s, 2) . ' sec');
        $output->writeln("Memory peak usage: " . round(memory_get_peak_usage() / 1048576, 2) . " Mb");
        $output->writeln("The end.");
    }
}

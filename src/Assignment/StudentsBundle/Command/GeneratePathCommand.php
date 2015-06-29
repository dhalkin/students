<?php

namespace Assignment\StudentsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GeneratePathCommand
 * @package Assignment\StudentsBundle\Command
 */
class GeneratePathCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('student:generate:path')
            ->setDescription('Generate route by names of student');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $s = microtime(true);
        $em = $this->getContainer()->get('doctrine')->getManager();
        $q = $em->createQuery('select s from AssignmentStudentsBundle:Student s');
        $iterableResult = $q->iterate();
        $arr = [];

        foreach ($iterableResult as $row) {
            $student = $row[0];

            if (array_key_exists($student->getName(), $arr)) {
                ++$arr[$student->getName()];
                $newPath = strtolower(str_replace(' ', '_', $student->getName()) . '_' . $arr[$student->getName()]);
            } else {
                $arr[$student->getName()] = 0;
                $newPath = strtolower(str_replace(' ', '_', $student->getName()));
            }
            $student->setPath($newPath);

        }
        $em->flush();
        $em->clear();

        $e = microtime(true);

        $output->writeln("Time elapsed " . round($e - $s, 2) . ' sec');
        $output->writeln("Memory usage: " . round(memory_get_usage() / 1024 / 1024, 2) . " Mb");
        $output->writeln("The end.");
    }
}

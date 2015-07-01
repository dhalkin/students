<?php

namespace Assignment\StudentsBundle\Services;

use Assignment\StudentsBundle\Entity\Student;
use Doctrine\ORM\EntityManager;

/**
 * Class GeneratePathService
 * @package Assignment\StudentsBundle\Services
 */
class GeneratePathService
{
    const BATCH_SIZE = 100;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var array
     */
    private $arrPaths = [];

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->arrPaths =[];
    }

    /**
     * Generate path
     */
    public function generate()
    {
        $i = 0;
        $q = $this->entityManager->createQuery('select s from AssignmentStudentsBundle:Student s');
        foreach ($q->iterate() as $row) {
            /** @var Student */
            $student = $row[0];
            $student->setPath($this->getPath($student->getName()));
            if (($i % self::BATCH_SIZE) === 0) {
                $this->entityManager->flush(); // Executes all updates.
                $this->entityManager->clear(); // Detaches all objects from Doctrine!
            }
            ++$i;
        }
        $this->entityManager->flush();
    }

    /**
     * @param string $name
     * @return string
     */
    public function getPath($name)
    {
        $name = preg_replace("/[^A-Za-z0-9 ]/", '', strip_tags($name));

        if (array_key_exists($name, $this->arrPaths)) {
            ++$this->arrPaths[$name];
            $newPath = strtolower(str_replace(' ', '_', $name) . '_' . $this->arrPaths[$name]);
        } else {
            $this->arrPaths[$name] = 0;
            $newPath = strtolower(str_replace(' ', '_', $name));
        }

        return $newPath;
    }
}

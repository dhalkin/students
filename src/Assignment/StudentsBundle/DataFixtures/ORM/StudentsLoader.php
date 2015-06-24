<?php

namespace Assignment\StudentsBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

/**
 * Class StudentsLoader
 * @package Assignment\StudentsBundle\DataFixtures\ORM
 */
class StudentsLoader extends DataFixtureLoader
{
    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {
        return  array(
            __DIR__ . '/students.yml',

        );
    }
}

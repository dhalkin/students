<?php

namespace Assignment\StudentsBundle\Tests\Services;

use Assignment\StudentsBundle\Services\GeneratePathService;

/**
 * Class GeneratePathServiceTest
 * @package Assignment\StudentsBundle\Tests\Services
 * @group unit
 */
class GeneratePathServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var GeneratePathService
     */
    private $service;

    /**
     *
     */
    public function setUp()
    {
        $this->entityManager = $this
            ->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();
        $this->service = new GeneratePathService($this->entityManager) ;
    }


    /**
     * @dataProvider dataSuccessProvider
     * @param string $expectedRes
     */
    public function testGetPath($expectedRes)
    {
        foreach ($expectedRes as list($name, $expectedPath)) {
            $this->assertEquals(
                $expectedPath,
                $this->service->getPath($name)
            );
        }

    }


    /**
     * @dataProvider dataFailProvider
     * @param string $name
     * @param string $expectedPath
     */
    public function testFailGetPath($name, $expectedPath)
    {
        $this->assertEquals(
            $expectedPath,
            $this->service->getPath($name)
        );
    }

    // +1 for separation different data providers

    /**
     * @return array
     */
    public function dataSuccessProvider()
    {

        return [
            ['expectedRes' => [
                    ['John Doe', 'john_doe'],
                    ['John Doe', 'john_doe_1'],
                    ['John Doe', 'john_doe_2'],
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public function dataFailProvider()
    {
        return [
            ['<br />', ''],
            ['<? ?>', ''],
            ['!@#$%^&*()+', ''],
        ];
    }
}

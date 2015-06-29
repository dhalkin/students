<?php

namespace Assignment\StudentsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Class StudentsControllerTest
 * @package Assignment\StudentsBundle\Tests\Controller
 * @group functional
 */
class StudentsControllerTest extends WebTestCase
{
    const MAX_AGE = 900;
    /**
     * @var Client
     */
    public $client;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * Test testDetailActionCheckCache
     */
    public function testDetailActionCheckCache()
    {
        $this->client->request('GET', '/students/detail/john_doe');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(self::MAX_AGE, $this->client->getResponse()->getMaxAge());
        $this->assertInstanceOf('DateTime', $this->client->getResponse()->getExpires());
    }

    /**
     * Test testDetailActionCheckGeneratePath
     */
    public function testDetailActionCheckGeneratePath()
    {
        $this->client->request('GET', '/students/detail/john_doe_2');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}

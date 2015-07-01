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
    const MIN = 15;
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
     * Test testDetailActionCache
     */
    public function testDetailActionCache()
    {
        $this->client->request('GET', '/students/detail/john_doe');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(self::MAX_AGE, $this->client->getResponse()->getMaxAge());
        $diff = date_diff($this->client->getResponse()->getExpires(), $this->client->getResponse()->getDate());
        $this->assertEquals(self::MIN, $diff->format('%i%'));
    }

    /**
     * Test testDetailActionGeneratePath
     */
    public function testDetailActionGeneratePath()
    {
        $this->client->request('GET', '/students/detail/john_doe_2');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}

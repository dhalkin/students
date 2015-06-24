<?php

namespace Assignment\StudentsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class DefaultControllerTest
 * @package Assignment\StudentsBundle\Tests\Controller
 */
class DefaultControllerTest extends WebTestCase
{

    /**
     *@inheritdoc
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello/Fabien');

        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }
}

<?php

namespace Assignment\StudentsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     * @param string $name
     * @return array
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
}

<?php

namespace Assignment\StudentsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Assignment\StudentsBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class StudentsController
 * @package Assignment\StudentsBundle\Controller
 */
class StudentsController extends Controller
{
    /**
     * @param Student $student
     *
     * @Route("/students/detail/{path}", name="detail")
     * @Cache(maxage="900", expires="15 minutes", public=true)
     * @Template
     * @return array
     */
    public function detailAction(Student $student)
    {
        return ['student' => $student];
    }
}

<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', array(
            'message' => 'Something something something!',
        ));
    }
    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('default/index.html.twig', array(
            'message' => 'llloooiiggn!',
        ));
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $user = $this->getUser();

        return $this->render('default/index.html.twig', [
            'message' => sprintf('Hi %s!', empty($user) ? 'anon' : $user->getUsername()),
        ]);
    }
}

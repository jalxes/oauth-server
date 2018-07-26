<?php

namespace App\Controller\Admin;

use \App\Service\Admin\Meta;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MetaController extends Controller
{
    /**
     * @Route("/meta", name="meta")
     */
    public function index(Request $request, Meta $service)
    {
        return new JsonResponse($service->dumpAll());
    }
}

<?php

namespace App\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserInfoController extends Controller
{
    /**
     * @Route("/userinfo", name="userinfo")
     */
    public function index(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return new JsonResponse([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
        ]);

        // return $this->render('default/index.html.twig', [
        //     'message' => json_encode([
        //         'username' => $user->getUsername(),
        //         'email' => $user->getEmail(),
        //         'roles' => $user->getRoles(),
        //     ]),
        // ]);
    }
}

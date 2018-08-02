<?php

namespace App\Controller\Admin;

use App\Service\Admin\UserManagement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/** * @Route("/user", name="user_management") */
class UserManagementController extends Controller
{
    /**
     * @Route("/add", name="add", methods="POST") #WIP change to json
     */
    public function add(Request $request, UserManagement $service)
    {
        $params = json_decode($request->getContent(), true);

        try {
            $service->add([
                'username' => $params['username'] ?? '',
                'password' => $params['password'] ?? '',
                'roles' => $params['roles'] ?? [\App\Entity\OauthUser::ROLE_DEFAULT],
            ]);

            return new JsonResponse(['status' => 'success']);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}

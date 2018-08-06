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
        try {
            $params = json_decode($request->getContent(), true);
            if (empty($params['roles'])) {
                $params['roles'] = [\App\Entity\OauthUser::ROLE_DEFAULT];
            }

            $service->add($params);

            return new JsonResponse(['status' => 'success']);
        } catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $exception) {
            return new JsonResponse(['status' => 'error', 'message' => sprintf("Duplicated Entry for '%s'", $params['username'])]);
        } catch (\Exception $exception) {
            return new JsonResponse(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }
}

<?php

namespace App\Service\Admin;

use  FOS\UserBundle\Model\UserManagerInterface;

class UserManagement
{
    /** @var UserManagerInterface */
    private $userManager;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    public function add(array $params)
    {
        if (empty($params['username'])) {
            throw new \Exception('username is needed!', 500);
        }
        if (empty($params['password'])) {
            throw new \Exception('password is needed!', 500);
        }
        if (empty($params['roles']) || !is_array($params['roles'])) {
            throw new \Exception('roles is needed and must be an array!', 500);
        }

        $user = $this->userManager->createUser();
        $user->setUsername($params['username']);
        $user->setPlainPassword($params['password']);
        $user->setRoles($params['roles']);
        $user->setImportedPassword($params['imported_password'] ?? true);
        $user->setEnabled(true);

        $this->userManager->updateUser($user);
    }
}

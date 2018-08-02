<?php

namespace App\EventListener;

use  FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginEventListener
{
    /** @var UserManagerInterface  */
    private $userManager;

    public function __construct(
        UserManagerInterface $userManager
    ) {
        $this->userManager = $userManager;
    }

    public function onLogin(InteractiveLoginEvent $event)
    {
        $user = $this->userManager->findUserByUsername(
            $event->getAuthenticationToken()->getUser()
        );
        if ($user->isImportedPassword()) {
            $credentials = $event->getAuthenticationToken()->getCredentials();

            $user->setImportedPassword(false);
            $user->setPassword($credentials);

            $this->userManager->updateUser($user);
        }
    }
}

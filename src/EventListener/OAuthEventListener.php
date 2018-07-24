<?php

namespace App\EventListener;

use FOS\OAuthServerBundle\Event\OAuthEvent;

class OAuthEventListener
{
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onPreAuthorizationProcess(OAuthEvent $event)
    {
        $user = $this->getUser($event);

        if (!empty($user)) {
            $event->setAuthorizedClient(
                $user->isAuthorizedClient($event->getClient())
            );
        }
    }

    public function onPostAuthorizationProcess(OAuthEvent $event)
    {
        if ($event->isAuthorizedClient()) {
            $client = $event->getClient();
            if (!empty($client)) {
                $user = $this->getUser($event);
                $user->addClient($client);
                $this->entityManager->save($user);
            }
        }
    }

    protected function getUser(OAuthEvent $event)
    {
        return $this->entityManager->getRepository(\App\Entity\OauthUser::class)
            ->findOneByUsername($event->getUser()->getUsername());
    }
}

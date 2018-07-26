<?php

namespace App\EventListener;

use App\Entity\ClientOauthUser;
use FOS\OAuthServerBundle\Event\OAuthEvent;

class OAuthEventListener
{
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onPreAuthorizationProcess(OAuthEvent $event)
    {
        $clientOauthUser = $this->getClientOauthUser($event);
        if (!empty($clientOauthUser)) {
            $event->setAuthorizedClient(
                $clientOauthUser->isAuthorized()
            );
        }
    }

    public function onPostAuthorizationProcess(OAuthEvent $event)
    {
        $clientOauthUser = $this->getClientOauthUser($event);
        if (empty($clientOauthUser)) {
            $clientOauthUser = new ClientOauthUser(
                $event->getUser(),
                $event->getClient()
            );
        }
        $clientOauthUser->setAuthorized($event->isAuthorizedClient());
        $this->entityManager->persist($clientOauthUser);
        $this->entityManager->flush();
    }

    private function getClientOauthUser(OAuthEvent $event)
    {
        return $this->entityManager->getRepository(\App\Entity\ClientOauthUser::class)
            ->findOneBy(['user' => $event->getUser(), 'client' => $event->getClient()]);
    }
}

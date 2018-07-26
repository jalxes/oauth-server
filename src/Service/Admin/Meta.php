<?php

namespace App\Service\Admin;

use App\Entity\AccessToken;
use App\Entity\AuthCode;
use App\Entity\Client;
use App\Entity\ClientOauthUser;
use App\Entity\OauthUser;
use App\Entity\RefreshToken;
use Doctrine\ORM\EntityManagerInterface;

class Meta
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function dumpAll(): array
    {
        return [
            'RefreshToken' => $this->dumpRefreshToken(),
            'AccessToken' => $this->dumpAccessToken(),
            'AuthCode' => $this->dumpAuthCode(),
            'Client' => $this->dumpClient(),
            'ClientOauthUser' => $this->dumpClientOauthUser(),
            'OauthUser' => $this->dumpOauthUser(),
        ];
    }

    public function dumpRefreshToken(): array
    {
        return $this->entityManager->createQuery('
            select 
                rt.id, 
                c.id as client_id, 
                u.id as user_id, 
                rt.token, 
                rt.expiresAt, 
                rt.scope 
            from App\\Entity\\RefreshToken rt
            join rt.client c
            join rt.user u
        ')->getResult();
    }

    public function dumpAccessToken(): array
    {
        return $this->entityManager->createQuery('
            select 
                at.id, 
                c.id as client_id, 
                u.id as user_id, 
                at.token, 
                at.expiresAt, 
                at.scope 
            from App\\Entity\\AccessToken at
            join at.client c
            join at.user u
        ')->getResult();
    }

    public function dumpAuthCode(): array
    {
        return $this->entityManager->createQuery('
            select 
                ac.id, 
                c.id as client_id, 
                u.id as user_id,    
                ac.token, 
                ac.expiresAt, 
                ac.scope 
            from App\\Entity\\AuthCode ac
            join ac.client c
            join ac.user u
        ')->getResult();
    }

    public function dumpClient(): array
    {
        return $this->entityManager->createQuery('
            select 
                c.id,
                c.randomId,
                c.secret,
                c.redirectUris,
                c.allowedGrantTypes
            from App\\Entity\\Client c
        ')->getResult();
    }

    public function dumpClientOauthUser(): array
    {
        return $this->entityManager->createQuery('
            select 
                cou.id, 
                c.id as client_id, 
                u.id as user_id,    
                cou.authorized
            from App\\Entity\\ClientOauthUser cou
            join cou.client c
            join cou.user u
        ')->getResult();
    }

    public function dumpOauthUser(): array
    {
        return $this->entityManager->createQuery('
            select 
                ou.id,
                ou.username,
                ou.usernameCanonical,
                ou.email,
                ou.emailCanonical,
                ou.enabled,
                ou.salt,
                ou.password,
                ou.lastLogin,
                ou.confirmationToken,
                ou.passwordRequestedAt,
                ou.roles
            from App\\Entity\\OauthUser ou
        ')->getResult();
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\Client as BaseClient;

/**
 * @ORM\Entity
 */
class Client extends BaseClient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="ClientOauthUser", mappedBy="client")
     */
    private $users;

    public function __construct()
    {
        parent::__construct();

        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
}

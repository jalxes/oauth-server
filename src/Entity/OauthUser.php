<?php
namespace App\Entity;

use FOS\UserBundle\Model\User;
use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Model\ClientInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="oauth_user")
 */
class OauthUser extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="ClientOauthUser", mappedBy="user")
     */
    private $clients;

    public function __construct()
    {
        parent::__construct();
        $this->clients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addClient(ClientInterface $client) : self
    {
        $this->clients->add($client);

        return $this;
    }
}

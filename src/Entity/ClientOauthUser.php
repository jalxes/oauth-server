<?php
namespace App\Entity;

use FOS\UserBundle\Model\User;
use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Model\ClientInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="client_oauth_user")
 */
class ClientOauthUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="OauthUser", inversedBy="clients")
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="users")
     */
    private $client;

    private $authorized;

    public function __construct(OauthUser $user, Client $client, bool $authorized)
    {
        $this->user = $user;
        $this->client = $client;
        $this->authorized = $authorized;
    }

    public function isAuthorized(ClientInterface $client) : bool
    {
        return $this->authorized;
    }
}

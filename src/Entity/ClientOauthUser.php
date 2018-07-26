<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    /**
     * @ORM\Column(type="boolean")
     */
    private $authorized = true;

    public function __construct(OauthUser $user, Client $client)
    {
        $this->user = $user;
        $this->client = $client;
    }

    public function isAuthorized(): bool
    {
        return $this->authorized;
    }

    public function setAuthorized(bool $authorized): self
    {
        $this->authorized = $authorized;

        return $this;
    }
}

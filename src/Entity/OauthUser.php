<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Model\ClientInterface;
use FOS\UserBundle\Model\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="oauth_user")
 * * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="email", column=@ORM\Column(nullable=true)),
 *      @ORM\AttributeOverride(name="emailCanonical", column=@ORM\Column(nullable=true))
 * })
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
     * @ORM\Column(type="boolean")
     */
    protected $importedPassword;

    /**
     * @ORM\OneToMany(targetEntity="ClientOauthUser", mappedBy="user")
     */
    private $clients;

    public function __construct()
    {
        parent::__construct();
        $this->clients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addClient(ClientInterface $client): self
    {
        $this->clients->add($client);

        return $this;
    }

    public function setImportedPassword(bool $importedPassword): self
    {
        $this->importedPassword = $importedPassword;

        return $this;
    }

    public function isImportedPassword(): bool
    {
        return $this->importedPassword;
    }
}

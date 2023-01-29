<?php

namespace App\Entity;




use Doctrine\ORM\Mapping as ORM;
//use Doctrine\ORM\\Mapping as Colmn;
use App\Repository\UserRepository;
use JMS\Serializer\Annotation\Groups;
use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
//use JMS\Serializer\Annotation\SerializedName;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;



/**
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "userShow",
 *          parameters = { "id" = "expr(object.getId())" }
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups="getUsers")
 * )
 *
 */


 /**
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "deleteUser",
 *          parameters = { "id" = "expr(object.getId())" }
 *      ),
 * )
 *
 */




/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */

 class User implements PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"getUsers"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     * @Groups({"getUsers"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"getUsers"})
     */
    private $email;


    /**
     * @var string The hashed password
     * @ORM\Column(type="string") 
     * @Groups({"getUsers"})    
     */
    private $password;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"getUsers"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="user")
     * @Groups({"getUsers"})
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getUsername(): string
    {
        return $this->username;
    }

    
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}

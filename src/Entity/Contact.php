<?php
namespace App\Entity;

use App\Repository\ContactRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @Assert\NotBlank()
     */
    private $first_name;

    /**
     * @var string|null
     * @Assert\NotBlank()
     */
    private $last_name;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;

    public function getFirstname(): ?string
    {
        return $this->first_name;
    }

    public function setFirstname(?string $first_name): Contact
    {
        $this->first_name = $first_name;

        return $this;
    }



    public function getLastname(): ?string
    {
        return $this->last_name;
    }

    public function setLastname(?string $last_name): Contact
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): Contact
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): Contact
    {
        $this->message = $message;

        return $this;
    }
}
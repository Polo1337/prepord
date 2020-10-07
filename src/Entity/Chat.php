<?php

namespace App\Entity;


use App\Entity\Chat;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChatRepository")
 */
class Chat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Auteur;

    /**
     * @ORM\Column(type="text")
     */
    private $Contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date_chat;

    /**
     * @ORM\ManyToOne(targetEntity=Match::class, inversedBy="chats")
     */
    private $match;


    public function __construct()
{
    $this->Date_chat = new \DateTime('now');
}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?string
    {
        return $this->Auteur;
    }

    public function setAuteur(string $Auteur): self
    {
        $this->Auteur = $Auteur;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(string $Contenu): self
    {
        $this->Contenu = $Contenu;

        return $this;
    }

    public function getDateChat(): ?\DateTimeInterface
    {
        return $this->Date_chat;
    }

    public function setDateChat(\DateTimeInterface $Date_chat): self
    {
        $this->Date_chat = $Date_chat;

        return $this;
    }

    public function getMatch(): ?match
    {
        return $this->match;
    }

    public function setMatch(?match $match): self
    {
        $this->match = $match;

        return $this;
    }
}

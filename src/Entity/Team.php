<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Match::class, inversedBy="teams")
     */
    private $play_matches;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="coaches")
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity=Season::class, inversedBy="teams")
     */
    private $play_season;

    /**
     * @ORM\ManyToMany(targetEntity=Player::class, mappedBy="play_in")
     */
    private $players;

    public function __construct()
    {
        $this->play_matches = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Match[]
     */
    public function getPlayMatches(): Collection
    {
        return $this->play_matches;
    }

    public function addPlayMatch(Match $playMatch): self
    {
        if (!$this->play_matches->contains($playMatch)) {
            $this->play_matches[] = $playMatch;
        }

        return $this;
    }

    public function removePlayMatch(Match $playMatch): self
    {
        if ($this->play_matches->contains($playMatch)) {
            $this->play_matches->removeElement($playMatch);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addCoach($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeCoach($this);
        }

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPlaySeason(): ?Season
    {
        return $this->play_season;
    }

    public function setPlaySeason(?Season $play_season): self
    {
        $this->play_season = $play_season;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->addPlayIn($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            $player->removePlayIn($this);
        }

        return $this;
    }
}

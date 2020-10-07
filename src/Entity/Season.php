<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeasonRepository::class)
 */
class Season
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $season_start;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $season_end;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="play_season")
     */
    private $teams;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeasonStart(): ?\DateTimeInterface
    {
        return $this->season_start;
    }

    public function setSeasonStart(?\DateTimeInterface $season_start): self
    {
        $this->season_start = $season_start;

        return $this;
    }

    public function getSeasonEnd(): ?\DateTimeInterface
    {
        return $this->season_end;
    }

    public function setSeasonEnd(?\DateTimeInterface $season_end): self
    {
        $this->season_end = $season_end;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setPlaySeason($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getPlaySeason() === $this) {
                $team->setPlaySeason(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Entity\PlayerStats;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    private $current_match;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lest_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birth_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $club_entry_date;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $stats = [];

    // private $statsObj;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $license_number;

    /**
     * @ORM\ManyToMany(targetEntity=Team::class, inversedBy="players")
     */
    private $play_in;

    /**
     * @ORM\ManyToMany(targetEntity=Post::class, inversedBy="players")
     */
    private $is_post;

    private $essais = [];
    private $transformations = [];
    private $penalites = [];
    private $drops = [];
    private $rouges = [];
    private $jaunes = [];
    private $temps = [];

    public function __construct()
    {
        $this->play_in = new ArrayCollection();
        $this->is_post = new ArrayCollection();
        $this->stats = [];
        // $this->statsObj = new PlayerStats();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLestName(): ?string
    {
        return $this->lest_name;
    }

    public function setLestName(string $lest_name): self
    {
        $this->lest_name = $lest_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

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

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(?\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getClubEntryDate(): ?\DateTimeInterface
    {
        return $this->club_entry_date;
    }

    public function setClubEntryDate(?\DateTimeInterface $club_entry_date): self
    {
        $this->club_entry_date = $club_entry_date;

        return $this;
    }

    public function getStats(): ?array
    {
        return $this->stats;
    }

    public function setStats(?array $stats): self
    {
        $this->stats = $stats;

        return $this;
    }
    // public function setStats(?array $stats): self
    // {
    //     $this->stats = $stats;

    //     return $this;
    // }

    public function getLicenseNumber(): ?int
    {
        return $this->license_number;
    }

    public function setLicenseNumber(?int $license_number): self
    {
        $this->license_number = $license_number;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getPlayIn(): Collection
    {
        return $this->play_in;
    }

    public function addPlayIn(Team $playIn): self
    {
        if (!$this->play_in->contains($playIn)) {
            $this->play_in[] = $playIn;
        }

        return $this;
    }

    public function removePlayIn(Team $playIn): self
    {
        if ($this->play_in->contains($playIn)) {
            $this->play_in->removeElement($playIn);
        }

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getIsPost(): Collection
    {
        return $this->is_post;
    }

    public function addIsPost(Post $isPost): self
    {
        if (!$this->is_post->contains($isPost)) {
            $this->is_post[] = $isPost;
        }

        return $this;
    }

    public function removeIsPost(Post $isPost): self
    {
        if ($this->is_post->contains($isPost)) {
            $this->is_post->removeElement($isPost);
        }

        return $this;
    }

    /**
     * Get the value of essais
     */ 
    public function getEssais($match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        return isset($this->stats[$match_id]['essais']) ? $this->stats[$match_id]['essais'] : 0;
    }

        /**
     * Get the total of essais
     */ 
    public function getTotalEssais()
    {
        $total = 0;
        if(isset($this->stats))
        {
            foreach($this->stats as $val) $total += $val['essais'];
        }
            
        return $total;
    }

    /**
     * Set the value of essais
     *
     * @return  self
     */ 
    public function setEssais($essais, $match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        $this->essais[$match_id] = $essais;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['essais'] = $essais;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of transformations
     */ 
    public function getTransformations($match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        return isset($this->stats[$match_id]['transformations']) ? $this->stats[$match_id]['transformations'] : 0;
    }

    /**
     * Get the total of transformations
     */ 
    public function getTotalTransformations()
    {
        $total = 0;
        if(isset($this->stats))
        {
            foreach($this->stats as $val) $total += $val['transformations'];
        }
        return $total;
    }

    /**
     * Set the value of transformations
     *
     * @return  self
     */ 
    public function setTransformations($transformations, $match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        $this->transformations[$match_id] = $transformations;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['transformations'] = $transformations;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of penalites
     */ 
    public function getPenalites($match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        return isset($this->stats[$match_id]['penalites']) ? $this->stats[$match_id]['penalites'] : 0;
    }

    /**
     * Get the total of penalites
     */ 
    public function getTotalPenalites()
    {
        $total = 0;
        if(isset($this->stats))
        {
            foreach($this->stats as $val) $total += $val['penalites'];
        }
        return $total;
    }

    /**
     * Set the value of penalites
     *
     * @return  self
     */ 
    public function setPenalites($penalites, $match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        $this->penalites[$match_id] = $penalites;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['penalites'] = $penalites;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of drops
     */ 
    public function getDrops($match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        return isset($this->stats[$match_id]['drops']) ? $this->stats[$match_id]['drops'] : 0;
    }

    /**
     * Get the total of drops
     */ 
    public function getTotalDrops()
    {
        $total = 0;
        if(isset($this->stats))
        {
            foreach($this->stats as $val) $total += $val['drops'];
        }
        return $total;
    }

    /**
     * Set the value of drops
     *
     * @return  self
     */ 
    public function setDrops($drops, $match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        $this->drops[$match_id] = $drops;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['drops'] = $drops;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of rouges
     */ 
    public function getRouges($match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        return isset($this->stats[$match_id]['rouges']) ? $this->stats[$match_id]['rouges'] : 0;
    }

    /**
     * Get the total of rouges
     */ 
    public function getTotalRouges()
    {
        $total = 0;
        if(isset($this->stats))
        {
            foreach($this->stats as $val) $total += $val['rouges'];
        }
        return $total;
    }

    /**
     * Set the value of rouges
     *
     * @return  self
     */ 
    public function setRouges($rouges, $match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        $this->rouges[$match_id] = $rouges;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['rouges'] = $rouges;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of jaunes
     */ 
    public function getJaunes($match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        return isset($this->stats[$match_id]['jaunes']) ? $this->stats[$match_id]['jaunes'] : 0;
    }

    /**
     * Get the total of jaunes
     */ 
    public function getTotalJaunes()
    {
        $total = 0;
        if(isset($this->stats))
        {
            foreach($this->stats as $val) $total += $val['jaunes'];
        }
        return $total;
    }

    /**
     * Set the value of jaunes
     *
     * @return  self
     */ 
    public function setJaunes($jaunes, $match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        $this->jaunes[$match_id] = $jaunes;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['jaunes'] = $jaunes;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of temps
     */ 
    public function getTemps($match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        return isset($this->stats[$match_id]['temps']) ? $this->stats[$match_id]['temps'] : 0;
    }

    /**
     * Get the total of temps
     */ 
    public function getTotalTemps()
    {
        $total = 0;
        if(isset($this->stats))
        {
            foreach($this->stats as $val) $total += $val['temps'];
        }
        return $total;
    }

    /**
     * Set the value of temps
     *
     * @return  self
     */ 
    public function setTemps($temps, $match_id = -1)
    {
        if($match_id==-1) $match_id = $this->current_match;
        $this->temps[$match_id] = $temps;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['temps'] = $temps;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Set the current match id
     *
     * @return  self
     */ 
    public function setCurrentMatch($match_id)
    {
        $this->current_match = $match_id;
        return $this;
    }
}
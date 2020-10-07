<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;


class PlayerMatchStats
{
    // essais transformations penalites drops rouge jaune temps_joué

    private $player;
    private $player_id;
    private $match;
    private $match_id;

    private $essais;
    private $transformations;
    private $penalites;
    private $drops;
    private $rouges;
    private $jaunes;
    private $temps;


    public function __construct($match, $player)
    {
        $this->player = $player;
        $this->player_id = $player->getId();
        $this->match = $match;
        $this->match_id = $match->getId();
    }
    /**
     * Get the value of essais
     * @Assert\Type("integer")
     */
    public function getEssais()
    {
        return $this->player->getEssais($this->match_id);
    }

    /**
     * Set the value of essais
     *
     * @return  self
     */ 
    public function setEssais($v)
    {
        $this->player->setEssais($match_id, $v);
        return $this;
    }

    /**
     * Get the value of transformations
     * @Assert\Type("integer")
     */ 
    public function getTransformations()
    {
        return $this->player->getTransformations($this->match_id);
    }

    /**
     * Set the value of transformations
     *
     * @return  self
     */ 
    public function setTransformations($v)
    {
        $this->player->setTransformations($match_id, $v);
        return $this;
    }

    /**
     * Get the value of penalites
     * @Assert\Type("integer")
     */ 
    public function getPenalites()
    {
        return $this->player->getPenalites($this->match_id);
    }

    /**
     * Set the value of penalites
     *
     * @return  self
     */ 
    public function setPenalites($v)
    {
        $this->player->setPenalites($match_id, $v);
        return $this;
    }

    /**
     * Get the value of drops
     * @Assert\Type("integer")
     */ 
    public function getDrops()
    {
        return $this->player->getDrops($this->match_id);
    }

    /**
     * Set the value of drops
     *
     * @return  self
     */ 
    public function setDrops($v)
    {
        $this->player->setDrops($match_id, $v);
        return $this;
    }

    /**
     * Get the value of rouge
     * @Assert\Type("integer")
     */ 
    public function getRouges()
    {
        return $this->getRouges($this->match_id);
    }

    /**
     * Set the value of rouge
     *
     * @return  self
     */ 
    public function setRouges($v)
    {
        $this->player->setRouges($match_id, $v);
        return $this;
    }

    /**
     * Get the value of jaune
     * @Assert\Type("integer")
     */ 
    public function getJaunes()
    {
        return $this->player->getJaunes($this->match_id);
    }

    /**
     * Set the value of jaune
     *
     * @return  self
     */ 
    public function setJaunes($v)
    {
        $this->player->setJaunes($match_id, $v);
        return $this;
    }

    /**
     * Get the value of temps
     * @Assert\DateTime
     */ 
    public function getTemps()
    {
        return $this->player->getTemps($this->match_id);
    }

    /**
     * Set the value of temps
     * 
     * @return  self
     */ 
    public function setTemps($v)
    {
        $this->player->setTemps($match_id, $v);
        return $this;
    }
}

?>
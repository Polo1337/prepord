<?php

namespace App\Entity;

class PlayerStats
{
    // essais transformations penalites drops rouge jaune temps_joué

    private $match_id;

    private $essais;
    private $transformations;
    private $penalites;
    private $drops;
    private $rouge;
    private $jaune;
    private $temps;





    /**
     * Get the value of essais
     */ 
    public function getEssais($match_id)
    {
        return $this->essais[$match_id];
    }

    /**
     * Set the value of essais
     *
     * @return  self
     */ 
    public function setEssais($match_id, $essais)
    {
        $this->essais[$match_id] = $essais;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['essais'] = $essais;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of transformations
     */ 
    public function getTransformations($match_id)
    {
        return $this->transformations;
    }

    /**
     * Set the value of transformations
     *
     * @return  self
     */ 
    public function setTransformations($match_id, $transformations)
    {
        $this->transformations[$match_id] = $transformations;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['transformations'] = $transformations;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of penalites
     */ 
    public function getPenalites($match_id)
    {
        return $this->penalites[$match_id];
    }

    /**
     * Set the value of penalites
     *
     * @return  self
     */ 
    public function setPenalites($match_id, $penalites)
    {
        $this->penalites[$match_id] = $penalites;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['penalites'] = $penalites;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of drops
     */ 
    public function getDrops($match_id)
    {
        return $this->drops[$match_id];
    }

    /**
     * Set the value of drops
     *
     * @return  self
     */ 
    public function setDrops($match_id, $drops)
    {
        $this->drops[$match_id] = $drops;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['drops'] = $drops;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of rouge
     */ 
    public function getRouge($match_id)
    {
        return $this->rouge[$match_id];
    }

    /**
     * Set the value of rouge
     *
     * @return  self
     */ 
    public function setRouge($match_id, $rouge)
    {
        $this->rouge[$match_id] = $rouge;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['rouge'] = $rouge;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of jaune
     */ 
    public function getJaune($match_id)
    {
        return $this->jaune[$match_id];
    }

    /**
     * Set the value of jaune
     *
     * @return  self
     */ 
    public function setJaune($match_id, $jaune)
    {
        $this->jaune[$match_id] = $jaune;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['jaune'] = $jaune;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of temps
     */ 
    public function getTemps($match_id)
    {
        return $this->temps[$match_id];
    }

    /**
     * Set the value of temps
     *
     * @return  self
     */ 
    public function setTemps($match_id, $temps)
    {
        $this->temps[$match_id] = $temps;
        $tmpStats = $this->getStats();
        $tmpStats[$match_id]['temps'] = $temps;
        $this->setStats($tmpStats);

        return $this;
    }
}
<?php

class Carousel
{
    protected $nbGroups;
    protected $groupSize;
    protected $nbRounds;
    protected $nbPlayers;

    public function __construct($nbGroups, $groupSize, $nbRounds, $nbPlayers)
    {
        $this->nbGroups = $nbGroups;
        $this->groupSize = $groupSize;
        $this->nbRounds = $nbRounds;
        $this->nbPlayers = $nbPlayers;
    }

    public function score()
    { }
}

class GeneticCarousel extends Carousel
{ }

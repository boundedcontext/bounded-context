<?php namespace BoundedContext\Player\Collection;

use BoundedContext\Contracts\Collection\Collection;

class Player implements \BoundedContext\Contracts\Player\Player
{
    protected $players;

    public function __construct(Collection $players)
    {
        $this->players = $players;
    }

    public function reset()
    {
        foreach($this->players as $player)
        {
            $player->reset();
        }
    }

    public function play($limit = 1000)
    {
        foreach($this->players as $player)
        {
            $player->play();
        }
    }
}

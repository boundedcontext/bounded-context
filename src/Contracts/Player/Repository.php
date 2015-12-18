<?php namespace BoundedContext\Contracts\Player;

use BoundedContext\Contracts\ValueObject\Identifier;

interface Repository
{
    /**
     * @param Identifier $id
     * @return Player
     */

    public function get(Identifier $id);

    /**
     * @param Player $player
     * @return void
     */

    public function save(Player $player);
}


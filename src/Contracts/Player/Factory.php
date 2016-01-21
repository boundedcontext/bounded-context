<?php namespace BoundedContext\Contracts\Player;

use BoundedContext\Contracts\Command\Handler;

interface Factory
{
    /**
     * Returns a Player for a Handler.
     *
     * @return Player $player
     */

    public function handler(Handler $handler);
}

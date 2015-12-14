<?php namespace BoundedContext\Contracts\Core;

use BoundedContext\Contracts\ValueObject\Identifier;

interface Playable
{
    /**
     * Returns the last id processed by the Playable object.
     *
     * @return Identifier
     */

    public function last_id();

    /**
     * Plays the Playable object.
     *
     * @param int $limit
     * @return void
     */

    public function play($limit = 1000);
}


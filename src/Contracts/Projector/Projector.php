<?php namespace BoundedContext\Contracts\Projector;

use BoundedContext\Contracts\Player\Player;
use BoundedContext\Contracts\Projection\Projection;

interface Projector extends Player
{
    /**
     * Returns the current Projection used by the Projector.
     *
     * @return Projection
     */

    public function projection();
}

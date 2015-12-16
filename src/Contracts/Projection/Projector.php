<?php namespace BoundedContext\Contracts\Projection;

use BoundedContext\Contracts\Core\Countable;
use BoundedContext\Contracts\Core\Playable;
use BoundedContext\Contracts\Core\ResetableByGenerator;
use BoundedContext\Contracts\Core\Versionable;

interface Projector extends ResetableByGenerator, Playable, Versionable, Countable
{
    /**
     * Returns the current Projection used by the Projector.
     *
     * @return Projection
     */

    public function projection();
}

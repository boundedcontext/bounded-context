<?php

namespace BoundedContext\Contracts\Projection;

use BoundedContext\Contracts\Core\Resetable;
use BoundedContext\Contracts\Core\Playable;
use BoundedContext\Contracts\Core\Versionable;

interface Projector extends Resetable, Playable, Versionable
{
    public function count();

    public function projection();
}

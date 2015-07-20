<?php namespace BoundedContext\Event;

use BoundedContext\Identifiable;
use BoundedContext\Collectable;
use BoundedContext\Versionable;
use BoundedContext\Event\Projector\Projectable;

interface Event extends Projectable, Collectable, Versionable, Identifiable
{
    /**
     * Gets a unique Uuid type.
     *
     * @return \BoundedContext\Uuid
     */
    public function type_id();
}

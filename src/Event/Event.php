<?php namespace BoundedContext\Event;

use BoundedContext\Identifiable;
use BoundedContext\Collection\Collectable;
use BoundedContext\Versionable;
use BoundedContext\Projector\Projectable;

interface Event extends Projectable, Collectable, Versionable, Identifiable
{
    /**
     * Gets a unique Uuid type.
     *
     * @return \BoundedContext\Uuid
     */
    public function type_id();
    
    public function toArray();
}

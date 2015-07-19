<?php namespace BoundedContext\Event;

use BoundedContext\Identifiable;
use BoundedContext\Collectable;
use BoundedContext\Versionable;
use BoundedContext\Event\Projector\Projectable;

interface Event extends Projectable, Collectable, Versionable, Identifiable
{
    public function type_id();
}

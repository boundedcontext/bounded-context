<?php namespace BoundedContext\Event;

use BoundedContext\Identifiable;
use BoundedContext\Collection\Collectable;
use BoundedContext\Projector\Projectable;
use BoundedContext\Versionable;

interface Event extends Projectable, Collectable, Identifiable, Versionable
{

    public function toArray();
}

<?php namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Collection\Collectable;
use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\ValueObject;
use BoundedContext\Contracts\Core\Versionable;
use BoundedContext\Projector\Projectable;

interface Item extends Identifiable, Collectable, Versionable, Projectable, ValueObject
{

}

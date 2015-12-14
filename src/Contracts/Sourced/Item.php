<?php namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Contracts\Core\Collectable;
use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\ValueObject\ValueObject;
use BoundedContext\Contracts\Core\Versionable;
use BoundedContext\Contracts\Core\Projectable;

interface Item extends Identifiable, Collectable, Versionable, Projectable, ValueObject
{

}

<?php namespace BoundedContext\Contracts\Snapshot;

use BoundedContext\Contracts\Core\Collectable;
use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\Core\Temporal;
use BoundedContext\Contracts\Core\Versionable;
use BoundedContext\Contracts\ValueObject\ValueObject;

interface Snapshot extends Identifiable, Versionable, Collectable, Temporal, ValueObject
{

}

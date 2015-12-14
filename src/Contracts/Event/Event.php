<?php namespace BoundedContext\Contracts\Event;

use BoundedContext\Contracts\Core\Collectable;
use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\ValueObject\ValueObject;

interface Event extends Identifiable, ValueObject, Collectable
{

}

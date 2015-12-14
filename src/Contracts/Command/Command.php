<?php namespace BoundedContext\Contracts\Command;

use BoundedContext\Contracts\Core\Collectable;
use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\ValueObject\ValueObject;

interface Command extends Identifiable, ValueObject, Collectable
{

}

<?php namespace BoundedContext\Contracts;

use BoundedContext\Collection\Collectable;
use BoundedContext\Contracts\Core\Identifiable;

interface Event extends Identifiable, ValueObject, Collectable
{

}

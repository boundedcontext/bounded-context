<?php namespace BoundedContext\Contracts\Entity;

use BoundedContext\Collection\Collectable;
use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\Core\Serializable;

interface Entity extends Identifiable, Serializable, Collectable
{

}

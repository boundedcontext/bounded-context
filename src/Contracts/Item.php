<?php namespace BoundedContext\Contracts;

use BoundedContext\Collection\Collectable;
use BoundedContext\Projector\Projectable;

interface Item extends Identifiable, Collectable, Versionable, Projectable, ValueObject
{

}

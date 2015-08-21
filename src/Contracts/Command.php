<?php namespace BoundedContext\Contracts;

use BoundedContext\Collection\Collectable;

interface Command extends Identifiable, ValueObject, Collectable
{

}

<?php namespace BoundedContext\ValueObject;

use BoundedContext\Contracts\ValueObject\ValueObject;

abstract class AbstractValueObject
{
    public function equals(ValueObject $other)
    {
        return ($this->serialize() === $other->serialize());
    }

    public abstract function serialize();
}

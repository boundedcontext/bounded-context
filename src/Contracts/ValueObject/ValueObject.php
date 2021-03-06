<?php namespace BoundedContext\Contracts\ValueObject;

use BoundedContext\Contracts\Core\Collectable;
use BoundedContext\Contracts\Core\Serializable;

interface ValueObject extends Serializable, Collectable
{

    /*
     * Evaluates whether or not two ValueObjects are equal.
     *
     * @return boolean
     */

    public function equals(ValueObject $other);
}

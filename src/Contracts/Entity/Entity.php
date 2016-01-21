<?php namespace BoundedContext\Contracts\Entity;

use BoundedContext\Contracts\Core\Collectable;
use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\Core\Serializable;

interface Entity extends Identifiable, Serializable, Collectable
{
    /*
     * Evaluates whether or not two Entities are equal.
     *
     * @return boolean
     */

    public function equals(Entity $other);
}

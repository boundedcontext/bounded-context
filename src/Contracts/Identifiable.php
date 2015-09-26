<?php namespace BoundedContext\Contracts;

use BoundedContext\ValueObject\Uuid;

interface Identifiable
{

    /**
     * Returns the objects unique identifier.
     *
     * @return Uuid
     */

    public function id();
}

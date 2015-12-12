<?php namespace BoundedContext\Contracts\Core;

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

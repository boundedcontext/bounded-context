<?php namespace BoundedContext\Contracts\Core;

use BoundedContext\Contracts\ValueObject\Identifier;

interface Identifiable
{
    /**
     * Returns the objects unique identifier.
     *
     * @return Identifier
     */

    public function id();
}

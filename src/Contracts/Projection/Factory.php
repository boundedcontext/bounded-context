<?php namespace BoundedContext\Contracts\Projection;

use BoundedContext\Contracts\ValueObject\Identifier;

interface Factory
{
    /**
     * @param Identifier $id
     * @return Projection
     */

    public function id(Identifier $id);
}

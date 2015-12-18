<?php namespace BoundedContext\Contracts\Projector;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\ValueObject\Integer;

interface Factory
{
    /**
     * Returns a new Projection from config.
     *
     * @param Identifier $id,
     * @param Identifier $last_id,
     * @param Integer $version
     *
     * @return Projector
     */

    public function create(
        Identifier $id,
        Identifier $last_item_id,
        Integer $version
    );
}

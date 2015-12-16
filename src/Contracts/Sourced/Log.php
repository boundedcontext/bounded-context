<?php

namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Core\Collectable;
use BoundedContext\Contracts\Core\Resetable;
use BoundedContext\Contracts\ValueObject\Identifier;

interface Log extends Resetable
{
    public function get_collection(Identifier $starting_id, $limit = 1000);

    public function append_collection(Collection $collection);

    public function append(Collectable $collectable);
}

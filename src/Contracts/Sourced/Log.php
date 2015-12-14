<?php

namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Collection\Collectable;
use BoundedContext\Collection\Collection;
use BoundedContext\Contracts\ValueObject\Identifier;

interface Log
{
    public function reset();

    public function get_collection(Identifier $starting_id, $limit = 1000);

    public function append_collection(Collection $collection);

    public function append(Collectable $collectable);
}
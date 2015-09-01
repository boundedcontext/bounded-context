<?php

namespace BoundedContext\Contracts;

use BoundedContext\Collection\Collectable;
use BoundedContext\Collection\Collection;
use BoundedContext\ValueObject\Uuid;

interface Log
{
    public function reset();

    public function get_collection(Uuid $starting_id, $limit = 1000);

    public function append_collection(Collection $collection);

    public function append(Collectable $collectable);
}
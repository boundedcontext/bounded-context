<?php

namespace BoundedContext\Contracts;

use BoundedContext\Collection\Collectable;
use BoundedContext\ValueObject\Uuid;

interface Map
{
    public function get_class(Uuid $id);

    public function get_id(Collectable $collectable);
}
<?php

namespace BoundedContext\Projection\AggregateCollections;

use BoundedContext\Collection\Collection;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Log\Item;

interface Projection extends \BoundedContext\Contracts\Projection\Projection {

    public function exists(Identifier $id);

    public function get(Identifier $id);

    public function append(Item $item);

    public function append_collection(Collection $items);
}

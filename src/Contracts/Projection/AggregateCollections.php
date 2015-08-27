<?php

namespace BoundedContext\Contracts\Projection;

use BoundedContext\Collection\Collection;
use BoundedContext\Log\Item;
use BoundedContext\ValueObject\Uuid;

interface AggregateCollections extends \BoundedContext\Contracts\Projection {

    public function exists(Uuid $id);

    public function get(Uuid $id);

    public function append(Item $item);

    public function append_collection(Collection $items);
}

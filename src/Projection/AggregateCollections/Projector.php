<?php

namespace BoundedContext\Projection\AggregateCollections;

use BoundedContext\Projector\AbstractProjector;
use BoundedContext\Contracts\Core\Projectable;

class Projector extends AbstractProjector
{
    protected function can_apply(Projectable $item)
    {
        return true;
    }

    protected function apply(Projectable $item)
    {
        $this->projection->append($item);

        $this->version = $this->version->increment();
        $this->count = $this->count->increment();
        $this->last_id = $item->id();
    }
}
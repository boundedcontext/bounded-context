<?php namespace BoundedContext\Projection\AggregateCollections;

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

        return $this->snapshot->take(
            $item->id()
        );
    }
}

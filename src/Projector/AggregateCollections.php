<?php

namespace BoundedContext\Projector;

use BoundedContext\Contracts\Log;
use BoundedContext\Contracts\Projection;

class AggregateCollections extends AbstractProjector
{
    public function __construct(Log $log, Projection\AggregateCollections $projection)
    {
        parent::__construct($log, $projection);
    }

    protected function can_apply(Projectable $item)
    {
        return true;
    }

    protected function apply(Projectable $item)
    {
        $this->projection->increment_version();
        $this->projection->increment_count();

        $this->projection->append($item);

        $this->projection->set_last_id($item->id());
    }
}
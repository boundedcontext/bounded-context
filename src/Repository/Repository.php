<?php

namespace BoundedContext\Repository;

use BoundedContext\ValueObject\Uuid;
use BoundedContext\Contracts\Aggregate;
use BoundedContext\Contracts\Log;
use \BoundedContext\Projection\AggregateCollections;

class Repository implements \BoundedContext\Contracts\Repository
{
    private $log;
    private $projector;
    private $aggregate;

    public function __construct(
        Log $log,
        AggregateCollections\Projector $projector,
        Aggregate $aggregate
    )
    {
        $this->log = $log;
        $this->projector = $projector;
        $this->aggregate = $aggregate;
    }

    public function get(Uuid $id)
    {
        $projection = $this->projector->projection();

        $aggregate_class = get_class($this->aggregate);
        $state = clone $this->aggregate->state();

        return new $aggregate_class(
            $id,
            $state,
            $projection->get($id)
        );
    }

    public function save(Aggregate $aggregate)
    {
        $this->log->append_collection(
            $aggregate->changes()
        );

        $this->projector->play();

        $aggregate->flush();
    }
}

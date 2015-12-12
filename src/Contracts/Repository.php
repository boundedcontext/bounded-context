<?php

namespace BoundedContext\Contracts;

use BoundedContext\Contracts;
use BoundedContext\Contracts\Sourced\Aggregate;
use BoundedContext\Contracts\Sourced\Log;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Projection\AggregateCollections;

/**
 * Interface Repository
 * @package BoundedContext\Contracts
 */
interface Repository {

    /**
     * @param Log $log
     * @param AggregateCollections\Projection $projection
     * @param Aggregate $aggregate
     */
    public function __construct(
        Sourced\Log $log,
        AggregateCollections\Projection $projection,
        Aggregate $aggregate
    );

    /**
     * @param Uuid $id
     * @return Aggregate
     */
    public function get(Uuid $id);

    /**
     * @param Aggregate $aggregate
     * @return void
     */
    public function save(Aggregate $aggregate);
}

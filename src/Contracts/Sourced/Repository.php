<?php

namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Contracts;
use BoundedContext\Contracts\Sourced;
use BoundedContext\Contracts\ValueObject\Identifier;
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
     * @param Identifier $id
     * @return \BoundedContext\Contracts\Sourced\Aggregate
     */
    public function get(Identifier $id);

    /**
     * @param Aggregate $aggregate
     * @return void
     */
    public function save(Aggregate $aggregate);
}

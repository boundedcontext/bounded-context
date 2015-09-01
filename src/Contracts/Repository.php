<?php

namespace BoundedContext\Contracts;

use BoundedContext\Contracts;
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
        Contracts\Log $log,
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

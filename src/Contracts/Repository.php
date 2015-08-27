<?php

namespace BoundedContext\Contracts;

use BoundedContext\Contracts;
use BoundedContext\ValueObject\Uuid;

/**
 * Interface Repository
 * @package BoundedContext\Contracts
 */
interface Repository {

    /**
     * @param Log $log
     * @param \BoundedContext\Projector\AggregateCollections $projector
     */
    public function __construct(Contracts\Log $log, \BoundedContext\Projector\AggregateCollections $projector);

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

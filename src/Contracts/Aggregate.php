<?php namespace BoundedContext\Contracts;

use BoundedContext\Collection\Collection;
use BoundedContext\ValueObject\Uuid;

interface Aggregate extends Identifiable, Versionable
{
    /**
     * Create a new instance of an Aggregate.
     *
     * @param Uuid $id
     * @param State $state
     * @param Collection $collection
     * @return void
     */

    public function __construct(Uuid $id, State $state, Collection $collection);

    /**
     * Get the current State of the Aggregate.
     *
     * @return State
     */

    public function state();

    /**
     * Get the Collection of new Events applied to the Aggregate.
     *
     * @return Collection
     */

    public function changes();

    /**
     * Flush any changes applied to the Aggregate.
     *
     * @return void
     */

    public function flush();
}

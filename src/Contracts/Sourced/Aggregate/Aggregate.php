<?php namespace BoundedContext\Contracts\Sourced\Aggregate;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;

interface Aggregate
{
    /**
     * Get the current state of the Aggregate.
     *
     * @return State
     */

    public function state();

    /**
     * Get the Collection of Log Snapshots applied to the Aggregate.
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

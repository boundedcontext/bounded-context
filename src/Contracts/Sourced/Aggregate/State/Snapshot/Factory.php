<?php namespace BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot;

use BoundedContext\Contracts\Sourced\Aggregate\State\State;

interface Factory
{
    /**
     * Returns a Snapshot from a State.
     *
     * @param State $state
     * @return Snapshot
     */

    public function state(State $state);
}

<?php namespace BoundedContext\Contracts\Sourced\Aggregate;

use BoundedContext\Contracts\Sourced\Aggregate\State\State;

interface Factory
{
    /**
     * Returns a new Aggregate.
     *
     * @param State $state
     * @return Aggregate
     */

    public function create(State $state);
}

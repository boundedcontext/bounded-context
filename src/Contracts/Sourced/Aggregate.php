<?php namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\Core\Versionable;

interface Aggregate extends Identifiable, Versionable
{
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

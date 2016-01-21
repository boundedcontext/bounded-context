<?php namespace BoundedContext\Contracts\Sourced\Aggregate\State;

use BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Snapshot;

interface Factory
{
    /**
     * Returns a State from a Snapshot.
     *
     * @param Snapshot $snapshot
     * @return State
     */

    public function snapshot(Snapshot $snapshot);
}

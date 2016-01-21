<?php namespace BoundedContext\Contracts\Sourced\Aggregate\State;

use BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Snapshot;

interface Repository
{
    /**
     * Returns the State by a Snapshot.
     *
     * @param Snapshot $snapshot
     * @return State
     */

    public function by_snapshot(Snapshot $snapshot);

    /**
     * Saves a State.
     *
     * @param State $state
     * @return void
     */

    public function save(State $state);
}

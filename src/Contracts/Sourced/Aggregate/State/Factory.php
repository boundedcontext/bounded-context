<?php namespace BoundedContext\Contracts\Sourced\Aggregate\State;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Snapshot;

interface Factory
{
    /**
     * Decorator.
     * Sets the Command associated with the State.
     *
     * @param Command $command
     * @return Factory
     */

    public function with(Command $command);

    /**
     * Returns a State from a Snapshot.
     *
     * @param Snapshot $snapshot
     * @return State
     */

    public function snapshot(Snapshot $snapshot);
}

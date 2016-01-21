<?php namespace BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot;

use BoundedContext\Contracts\Command\Command;

interface Factory
{
    /**
     * Returns a Snapshot from a Command.
     *
     * @param Command $command
     * @return Snapshot
     */

    public function command(Command $command);
}

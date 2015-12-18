<?php namespace BoundedContext\Contracts\Command;

use BoundedContext\Collection\Collection;

interface Handler
{
    /**
     * Handles a Command and returns a collection of Projections used by the Handler.
     *
     * @param Command $command
     * @throws \Exception
     * @return Collection
     */

    public function handle(Command $command);
}

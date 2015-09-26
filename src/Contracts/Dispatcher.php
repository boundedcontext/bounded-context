<?php namespace BoundedContext\Contracts;

use BoundedContext\Collection\Collection;

interface Dispatcher
{
    /**
     * Dispatches a Command to the bus.
     *
     * @param Command $command
     * @return void
     */

    public function dispatch(Command $command);

    /**
     * Dispatches a Collection of Commands to the bus.
     *
     * @param Collection $commands
     * @return void
     */

    public function dispatch_collection(Collection $commands);
}

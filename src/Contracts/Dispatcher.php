<?php namespace BoundedContext\Contracts;

use BoundedContext\Collection\Collection;

interface Dispatcher
{
    public function dispatch(Command $command);

    public function dispatch_collection(Collection $commands);
}

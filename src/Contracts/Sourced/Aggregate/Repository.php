<?php namespace BoundedContext\Contracts\Sourced\Aggregate;

use BoundedContext\Contracts\Command\Command;

interface Repository {

    /**
     * @param Command $command
     * @return Aggregate
     */

    public function by_command(Command $command);

    /**
     * @param Aggregate $aggregate
     * @return void
     */

    public function save(Aggregate $aggregate);
}

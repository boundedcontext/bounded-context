<?php namespace BoundedContext\Sourced\Aggregate\State\Snapshot;

use BoundedContext\Contracts\Generator\Identifier;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Contracts\Generator\DateTime as DateTimeGenerator;
use BoundedContext\Schema\Schema;

class Factory implements \BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Factory
{
    private $identifier_generator;
    private $datetime_generator;

    public function __construct(
        Identifier $identifier_generator,
        DateTimeGenerator $datetime_generator
    )
    {
        $this->identifier_generator = $identifier_generator;
        $this->datetime_generator = $datetime_generator;
    }

    public function state(State $state)
    {
        return new Snapshot(
            $this->identifier_generator->generate(),
            $state->version(),
            $this->datetime_generator->now(),
            new Schema($state->serialize())
        );
    }
}

<?php namespace BoundedContext\Sourced\Aggregate;

use BoundedContext\Contracts\Business\Invariant\Factory;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;

class Check
{
    protected $invariant_factory;
    protected $state;

    public function __construct(Factory $invariant_factory, State $state)
    {
        $this->invariant_factory = $invariant_factory;
        $this->state = $state;
    }

    public function is($class, $parameters = [])
    {
        $invariant = $this->invariant_factory
            ->with($this->state->queryable())
            ->by_class($class, $parameters);

        return $invariant->is_satisfied();
    }

    public function not($class, $parameters = [])
    {
        $invariant = $this->invariant_factory
            ->with($this->state->queryable())
            ->by_class($class, $parameters);

        return $invariant->not()->is_satisfied();
    }
}

<?php namespace BoundedContext\Sourced\Aggregate;

class Assertion extends Check
{
    public function is($class, $parameters = [])
    {
        $invariant = $this->invariant_factory
            ->with($this->state->queryable())
            ->by_class($class, $parameters);

        $invariant->assert();
    }

    public function not($class, $parameters = [])
    {
        $invariant = $this->invariant_factory
            ->with($this->state->queryable())
            ->by_class($class, $parameters);

        $invariant->not()->assert();
    }
}

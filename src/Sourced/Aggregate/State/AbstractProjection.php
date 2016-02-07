<?php namespace BoundedContext\Sourced\Aggregate\State;

use BoundedContext\Contracts\Projection\Projection;
use BoundedContext\ValueObject\AbstractValueObject;

abstract class AbstractProjection extends AbstractValueObject implements Projection
{
    public function reset()
    {
        throw new \Exception("Resetting a State Projection is not supported in this version.");
    }

    public function queryable()
    {
        return $this;
    }
}

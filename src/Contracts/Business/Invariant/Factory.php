<?php namespace BoundedContext\Contracts\Business\Invariant;

interface Factory
{
    /**
     * Returns an instance of an Invariant.
     *
     * @throws Exception
     * @return Invariant
     */

    public function by_class($class, $params = []);
}

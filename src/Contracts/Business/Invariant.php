<?php namespace BoundedContext\Contracts\Business;

use BoundedContext\Contracts\Business\InvariantException;

interface Invariant
{
    /**
     * Returns whether or not the invariant has been satisfied.
     *
     * @return boolean
     */

    public function is_satisfied();

    /**
     * Asserts the invariant.
     *
     * @throws InvariantException
     * @return void
     */

    public function assert();
}
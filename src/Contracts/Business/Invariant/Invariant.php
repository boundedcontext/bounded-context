<?php namespace BoundedContext\Contracts\Business\Invariant;

use BoundedContext\Contracts\Business\Invariant\Exception;

interface Invariant
{
    /**
     * Configures the Invariant to be a not Invariant.
     *
     * @return Invariant
     */

    public function not();

    /**
     * Returns whether or not the invariant has been satisfied.
     *
     * @return boolean
     */

    public function is_satisfied();

    /**
     * Asserts the invariant.
     *
     * @throws Exception
     * @return void
     */

    public function assert();
}

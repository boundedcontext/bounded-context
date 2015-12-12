<?php namespace BoundedContext\Contracts\Business;

use BoundedContext\Invariant\Exception;

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
     * @throws Exception
     * @return void
     */

    public function assert();
}
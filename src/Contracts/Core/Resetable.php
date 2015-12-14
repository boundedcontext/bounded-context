<?php namespace BoundedContext\Contracts\Core;

use BoundedContext\Contracts\Generator;

interface Resetable
{
    /**
     * Resets the state of the Resettable object.
     *
     * @param Generator\Identifier $generator
     * @return void
     */

    public function reset(Generator\Identifier $generator);
}
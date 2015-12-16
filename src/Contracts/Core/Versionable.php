<?php namespace BoundedContext\Contracts\Core;

use BoundedContext\ValueObject\Integer;

interface Versionable
{
    /**
     * Gets a version number.
     *
     * @return Integer
     */

    public function version();
}

<?php namespace BoundedContext\Contracts\Core;

interface Versionable
{
    /**
     * Gets a version number.
     *
     * @return int
     */

    public function version();
}

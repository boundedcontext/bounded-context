<?php namespace BoundedContext\Contracts\Core;

use BoundedContext\ValueObject\Integer as Version;

interface Versionable
{
    /**
     * Gets the current version of the Versionable Object.
     *
     * @return Version
     */
    public function version();
}

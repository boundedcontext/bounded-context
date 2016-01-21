<?php namespace BoundedContext\Contracts\Schema;

use BoundedContext\Contracts\Core\Versionable;

interface Snapshot extends Versionable
{
    /**
     * Gets the schema for the Snapshot.
     *
     * @return Schema
     */

    public function schema();
}

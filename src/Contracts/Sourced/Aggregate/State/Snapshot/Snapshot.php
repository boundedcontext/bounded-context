<?php namespace BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot;

use BoundedContext\Contracts\Schema\Schema;

interface Snapshot extends \BoundedContext\Contracts\Snapshot\Snapshot
{
    /**
     * Gets the schema for the current Snapshot.
     *
     * @return Schema
     */

    public function schema();
}

<?php namespace BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot;

use BoundedContext\Contracts\ValueObject\Identifier;

interface Repository
{
    /**
     * Returns the Snapshot by an Identifier.
     *
     * @return Snapshot
     */

    public function id(Identifier $id);

    /**
     * Saves a Snapshot.
     *
     * @return void
     */

    public function save(Snapshot $snapshot);
}

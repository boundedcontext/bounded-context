<?php namespace BoundedContext\Contracts\Event\Snapshot;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\ValueObject\Integer as Version;

interface Stream
{
    /**
     * Sets that the Stream should look for snapshots after a version.
     *
     * @param Version $version
     * @return Stream
     */

    public function after(Version $version);

    /**
     * Sets that the Stream should look for snapshots with an id.
     *
     * @return Stream
     */

    public function with(Identifier $id);

    /**
     * Gets the resulting Snapshots.
     *
     * @return Collection
     */

    public function as_collection();
}

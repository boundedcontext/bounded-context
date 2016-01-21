<?php namespace BoundedContext\Contracts\Event\Snapshot;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\ValueObject\Integer;

interface Stream
{
    /**
     * Sets that the Stream should look for snapshots after a version.
     *
     * @param Integer $version
     * @return Stream
     */

    public function after(Integer $version);

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

    public function get();
}

<?php namespace BoundedContext\Contracts\Event;

use BoundedContext\Contracts\Event\Snapshot\Snapshot;

interface Factory
{
    /**
     * Returns a new Event from an existing Snapshot.
     *
     * @param Snapshot $snapshot
     * @return Event
     */

    public function snapshot(Snapshot $snapshot);

    /**
     * Returns an instance of an Invariant.
     *
     * @throws \Exception
     * @return Event
     */

    public function by_class($class, $params = []);
}

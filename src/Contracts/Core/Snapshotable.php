<?php namespace BoundedContext\Contracts\Core;

use BoundedContext\Contracts\Core\Snapshot\Snapshot;

interface Snapshotable
{
    /**
     * Returns the current snapshot of the Snapshotable object.
     *
     * @return Snapshot
     */

    public function snapshot();
}

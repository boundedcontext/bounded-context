<?php namespace BoundedContext\Contracts\Sourced\Log;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Core\Resetable;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;
use BoundedContext\Contracts\ValueObject\Identifier;

interface Log extends Resetable
{
    /**
     * Returns a Collection of Snapshots from the Log.
     *
     * @param Identifier $starting_id
     * @param int $limit
     * @return Collection
     */

    public function get_collection(Identifier $starting_id, $limit = 1000);

    /**
     * Appends a Collection of Snapshots to the end of the Log.
     *
     * @param Collection $snapshots
     * @return void
     */

    public function append_collection(Collection $snapshots);

    /**
     * Appends a Snapshot to the end of the Log.
     *
     * @param Snapshot $snapshot
     * @return void
     */

    public function append(Snapshot $snapshot);
}

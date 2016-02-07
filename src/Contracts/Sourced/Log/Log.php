<?php namespace BoundedContext\Contracts\Sourced\Log;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Core\Resetable;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;
use BoundedContext\Contracts\Sourced\Stream\Builder;

interface Log extends Resetable
{
    /**
     * Returns a new Stream for the Log.
     *
     * @return Builder
     */
    public function builder();

    /**
     * Appends a Snapshot to the end of the Log.
     *
     * @param Snapshot $snapshot
     * @return void
     */

    public function append(Snapshot $snapshot);

    /**
     * Appends a Collection of Snapshots to the end of the Log.
     *
     * @param Collection $snapshots
     * @return void
     */

    public function append_collection(Collection $snapshots);
}

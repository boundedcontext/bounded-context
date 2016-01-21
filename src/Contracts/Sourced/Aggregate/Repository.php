<?php namespace BoundedContext\Contracts\Sourced\Aggregate;

use BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Snapshot;

interface Repository {

    /**
     * @param Snapshot $snapshot
     * @return Aggregate
     */

    public function by_snapshot(Snapshot $snapshot);

    /**
     * @param Aggregate $aggregate
     * @return void
     */

    public function save(Aggregate $aggregate);
}

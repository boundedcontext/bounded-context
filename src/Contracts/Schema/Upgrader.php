<?php namespace BoundedContext\Contracts\Schema;

interface Upgrader
{
    /**
     * Returns an upgraded version of the Schema.
     *
     * @param Snapshot $schema_snapshot
     * @return Snapshot
     */

    public function upgrade(Snapshot $schema_snapshot);
}

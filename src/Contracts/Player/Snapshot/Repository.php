<?php namespace BoundedContext\Contracts\Player\Snapshot;

use BoundedContext\Contracts\ValueObject\Identifier;

interface Repository
{
    /**
     * @param Identifier $id
     * @return Snapshot
     */

    public function get(Identifier $id);

    /**
     * @param Snapshot $snapshot
     * @return void
     */

    public function save(Snapshot $player);
}

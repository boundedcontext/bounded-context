<?php namespace BoundedContext\Contracts\Event\Snapshot;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Schema\Schema;

interface Factory
{
    /**
     * Returns a new Snapshot from an Event.
     *
     * @param Event $event
     * @return Snapshot $snapshot
     */

    public function event(Event $event);

    /**
     * Returns a new Snapshot from a Collections of Events.
     *
     * @param Collection $events
     * @return Collection $event_snapshots
     */

    public function collection(Collection $events);

    /**
     * Returns a new Snapshot from a Schema.
     *
     * @param Schema $schema
     * @return Snapshot $snapshot
     */

    public function schema(Schema $schema);
}

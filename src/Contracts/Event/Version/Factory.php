<?php namespace BoundedContext\Contracts\Event\Version;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\ValueObject\Integer;

interface Factory
{
    /**
     * Returns a new Snapshot from an Event.
     *
     * @param Event $event
     * @return \BoundedContext\ValueObject\Integer $version
     */

    public function event(Event $event);
}

<?php namespace BoundedContext\Contracts\Event\Version;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\ValueObject\Integer as Integer_;

interface Factory
{
    /**
     * Returns a new Snapshot from an Event.
     *
     * @param Event $event
     * @return Integer_ $version
     */

    public function event(Event $event);
}

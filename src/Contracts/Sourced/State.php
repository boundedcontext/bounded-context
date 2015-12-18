<?php

namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Contracts\Core\Snapshotable;
use BoundedContext\Contracts\Event\Event;

interface State extends Snapshotable
{
    /**
     * Applies a new Event to the State.
     *
     * @param Event $event
     * @throws \Exception
     * @return void
     */

    public function apply(Event $event);
}

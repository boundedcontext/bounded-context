<?php

namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Contracts\Event\Event;

interface State
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

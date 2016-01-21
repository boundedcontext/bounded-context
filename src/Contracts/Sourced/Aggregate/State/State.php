<?php

namespace BoundedContext\Contracts\Sourced\Aggregate\State;

use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\Core\Serializable;
use BoundedContext\Contracts\Core\Versionable;
use BoundedContext\Contracts\Event\Event;

interface State extends Identifiable, Versionable, Serializable
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

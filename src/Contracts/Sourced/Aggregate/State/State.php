<?php namespace BoundedContext\Contracts\Sourced\Aggregate\State;

use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\Core\Serializable;
use BoundedContext\Contracts\Core\Versionable;
use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Projection\Queryable;

interface State extends Identifiable, Versionable, Serializable
{
    /**
     * @return Queryable
     */
    public function queryable();

    /**
     * Applies an Event to the State.
     *
     * @param Event $event
     * @throws \Exception
     * @return void
     */
    public function apply(Event $event);
}

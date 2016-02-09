<?php namespace BoundedContext\Contracts\Sourced\Log;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Core\Resetable;
use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Sourced\Stream\Builder;

interface Log extends Resetable
{
    /**
     * Returns a new Stream Builder for the Log.
     *
     * @return Builder
     */
    public function builder();

    /**
     * Appends an Event to the end of the Log.
     *
     * @param Event $event
     * @return void
     */

    public function append(Event $event);

    /**
     * Appends a Collection of Events to the end of the Log.
     *
     * @param Collection $events
     * @return void
     */

    public function append_collection(Collection $events);
}

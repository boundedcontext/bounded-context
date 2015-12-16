<?php

namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Core\Resetable;
use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\ValueObject\Identifier;

interface Log extends Resetable
{
    /**
     * Returns a Collection of Items from the Log.
     *
     * @param Identifier $starting_id
     * @param int $limit
     * @return Collection
     */

    public function get_collection(Identifier $starting_id, $limit = 1000);

    /**
     * Appends a Collection of Items to the end of the Log.
     *
     * @param Collection $items
     * @return void
     */

    public function append_collection(Collection $collection);

    /**
     * Appends an Item to the end of the Log.
     *
     * @param Event $event
     * @return void
     */

    public function append(Event $event);
}

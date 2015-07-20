<?php namespace BoundedContext\Event\Log;

use BoundedContext\Collection\Collection;
use BoundedContext\Event\Event;

interface Log
{

    public function append_collection(Collection $collection);

    public function append_event(Event $event);
}

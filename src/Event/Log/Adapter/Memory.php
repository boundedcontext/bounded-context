<?php namespace BoundedContext\Event\Log\Adapter;

use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;
use BoundedContext\Event\Event;
use BoundedContext\Event\Log\Log;
use BoundedContext\Event\Log\Item;
use BoundedContext\Map\Map;

class Memory implements Log
{

    private $map;
    private $collection;

    public function __construct(Map $map, Collection $collection)
    {
        $this->map = $map;
        $this->collection = $collection;
    }

    public function dump()
    {
        return $this->collection;
    }

    public function append_collection(Collection $collection)
    {
        foreach ($collection as $event) {
            $this->append_event($event);
        }
    }

    public function append_event(Event $event)
    {
        $type_id = new Uuid($this->map->reverse_lookup(get_class($event)));

        $item = new Item(Uuid::generate(), $type_id, $event->occured_at(), 1, $event);

        $this->collection->append($item);
    }
}

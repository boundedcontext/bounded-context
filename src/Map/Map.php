<?php

namespace BoundedContext\Map;

use BoundedContext\Contracts\Event;
use BoundedContext\ValueObject\Uuid;

class Map implements \BoundedContext\Contracts\Map
{
    private $id_map;
    private $event_class_map;

    public function __construct(array $event_map = [])
    {
        foreach($event_map as $id => $event_class)
        {
            $this->id_map[$id] = $event_class;
            $this->event_class_map[$event_class] = $id;
        }
    }

    public function get_event_class(Uuid $id)
    {
        return $this->id_map[$id->serialize()];
    }

    public function get_id(Event $class)
    {
        return new Uuid($this->event_class_map[get_class($class)]);
    }
}
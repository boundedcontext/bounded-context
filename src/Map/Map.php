<?php

namespace BoundedContext\Map;

use BoundedContext\Collection\Collectable;
use BoundedContext\ValueObject\Uuid;

class Map implements \BoundedContext\Contracts\Map
{
    private $id_map;
    private $class_map;

    public function __construct(array $class_map = [])
    {
        foreach($class_map as $id => $class)
        {
            $this->id_map[$id] = $class;
            $this->class_map[$class] = $id;
        }
    }

    public function get_class(Uuid $id)
    {
        return $this->id_map[$id->serialize()];
    }

    public function get_id(Collectable $class)
    {
        return new Uuid($this->class_map[get_class($class)]);
    }
}
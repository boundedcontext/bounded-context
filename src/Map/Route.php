<?php namespace BoundedContext\Map;

use BoundedContext\ValueObject\Uuid;
use BoundedContext\Identifiable;
use BoundedContext\Collection\Collectable;

class Route implements Identifiable, Collectable
{

    private $id;
    private $class_namespace;

    public function __construct(Uuid $id, $class_namespace)
    {
        $this->id = $id;
        $this->class_namespace = $class_namespace;
    }

    public function id()
    {
        return $this->id;
    }

    public function class_namespace()
    {
        return $this->class_namespace;
    }
}

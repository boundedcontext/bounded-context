<?php namespace BoundedContext\Log;

use BoundedContext\Contracts\Serializable;
use BoundedContext\ValueObject\DateTime;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\ValueObject\Version;

class Item implements \BoundedContext\Contracts\Sourced\Item
{
    private $id;
    private $type_id;
    private $occurred_at;
    private $version;
    private $payload;

    public function __construct(Uuid $id, Uuid $type_id, DateTime $occurred_at, Version $version, Serializable $payload)
    {
        $this->id = $id;
        $this->type_id = $type_id;
        $this->occurred_at = $occurred_at;
        $this->version = $version;
        $this->payload = $payload;
    }

    public function id()
    {
        return $this->id;
    }

    public function type_id()
    {
        return $this->type_id;
    }

    public function occurred_at()
    {
        return $this->occurred_at;
    }

    public function version()
    {
        return $this->version;
    }

    public function payload()
    {
        return $this->payload;
    }

    public function serialize()
    {
        $class_vars = (new \ReflectionObject($this))->getProperties(\ReflectionProperty::IS_PRIVATE);

        $command = [];

        foreach ($class_vars as $property) {
            $name = $property->getName();
            $command[$name] = $this->$name->serialize();
        }

        return $command;
    }

    public static function deserialize($array = [])
    {
        dd($array);
    }
}

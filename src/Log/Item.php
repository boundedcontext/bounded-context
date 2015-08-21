<?php namespace BoundedContext\Log;

use BoundedContext\Contracts\Event;
use BoundedContext\ValueObject\DateTime;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\ValueObject\Version;

class Item implements \BoundedContext\Contracts\Item
{
    private $id;
    private $type_id;
    private $occurred_at;
    private $version;
    private $event;

    public function __construct(Uuid $id, Uuid $type_id, DateTime $occurred_at, Version $version, Event $event)
    {
        $this->id = $id;
        $this->type_id = $type_id;
        $this->occurred_at = $occurred_at;
        $this->version = $version;
        $this->event = $event;
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

    public function event()
    {
        return $this->event;
    }

    public function toString()
    {
        return $this->id->toString();
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

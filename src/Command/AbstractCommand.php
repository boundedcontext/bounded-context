<?php namespace BoundedContext\Command;

use BoundedContext\Contracts\Command;
use BoundedContext\ValueObject\Uuid;

class AbstractCommand implements Command
{
    private $id;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }

    public function toString()
    {
        return $this->id->toString();
    }

    public function serialize()
    {
        $class_vars = (new \ReflectionObject($this))->getProperties(\ReflectionProperty::IS_PUBLIC);

        $command = [];

        foreach ($class_vars as $property) {
            $name = $property->getName();
            $command[$name] = $this->$name->serialize();
        }

        return $command;
    }
}

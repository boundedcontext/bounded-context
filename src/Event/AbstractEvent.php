<?php namespace BoundedContext\Event;

use BoundedContext\Contracts\Event;
use BoundedContext\ValueObject\Uuid;

class AbstractEvent implements Event
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
        return $this->id;
    }

    public function serialize()
    {
        $class_vars = (new \ReflectionObject($this))->getProperties(\ReflectionProperty::IS_PUBLIC);

        $event = [
            'id' => $this->id->serialize()
        ];

        foreach ($class_vars as $property) {
            $name = $property->getName();
            $event[$name] = $this->$name->serialize();
        }

        return $event;
    }

    public static function deserialize($array = [])
    {
        $event_class = get_called_class();
        $class_params = (new \ReflectionClass($event_class))
            ->getMethod('__construct')
            ->getParameters();

        $params = [];
        foreach($class_params as $class_param)
        {
            $class = $class_param->getClass()->name;
            $name = $class_param->name;

            $params[] = $class::deserialize($array[$name]);
        }

        $event_class = new \ReflectionClass($event_class);

        return $event_class->newInstanceArgs($params);
    }
}

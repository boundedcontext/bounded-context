<?php namespace BoundedContext\Sourced\Aggregate\State;

use BoundedContext\Contracts\Projection\Projection;
use BoundedContext\ValueObject\AbstractValueObject;

abstract class AbstractProjection extends AbstractValueObject implements Projection
{
    public function reset()
    {
        throw new \Exception("Resetting a State Projection is not supported in this version.");
    }

    public function queryable()
    {
        return $this;
    }

    public function serialize()
    {
        $class = new \ReflectionClass(get_called_class());
        $properties = $class->getProperties();

        $serialized = [];

        foreach ($properties as $index => $property)
        {
            $name = $property->getName();
            $value = $this->$name;
            $serialized[$name] = $value->serialize();
        }

        return $serialized;
    }
}

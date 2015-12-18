<?php namespace BoundedContext\ValueObject;

use BoundedContext\Contracts\ValueObject\ValueObject;

abstract class AbstractValueObject
{
    public function equals(ValueObject $other)
    {
        return ($this->serialize() === $other->serialize());
    }

    public function serialize()
    {
        $reflection = new \ReflectionClass($this);

        $properties = $reflection->getProperties();

        $serialised = [];

        foreach($properties as $property)
        {
            $serialised[$property->getName()] = $property->getValue()->serialize();
        }

        return $serialised;
    }

    public static function deserialize($serialised = null)
    {
        if(is_null($serialised))
        {
            throw new \Exception("Having problems deserializing...");
        }

        $deserialised = [];

        $reflection = new \ReflectionClass(self);

        $properties = $reflection->getProperties();
        foreach($properties as $property)
        {
            $property_name = $property->getName();
            $property_class = $property->class;

            $deserialised[$property_name] = $property_class::deserialize(
                $serialised[$property_name]
            );
        }

        return $reflection->newInstanceArgs($deserialised);
    }
}

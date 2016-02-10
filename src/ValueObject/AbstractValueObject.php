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
        $class = new \ReflectionClass(get_called_class());
        $parameters = $class->getConstructor()->getParameters();

        $serialized = [];
        foreach ($parameters as $index => $parameter)
        {
            $name = $parameter->getName();
            $value = $this->$name;

            if(is_object($value))
            {
                $serialized[$name] = $value->serialize();
            } else
            {
                $serialized[$name] = $value;
            }
        }

        return $serialized;
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

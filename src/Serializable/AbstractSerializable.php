<?php namespace BoundedContext\Serializable;

class AbstractSerializable
{
    public function serialize()
    {
        $class_vars = (new \ReflectionObject($this))
            ->getProperties(\ReflectionProperty::IS_PUBLIC);

        $serialized = [];

        foreach ($class_vars as $property) {
            $name = $property->getName();
            $serialized[$name] = $this->$name->serialize();
        }

        return $serialized;
    }

    public static function deserialize($array = [])
    {
        $serializable_class = get_called_class();
        $class_params = (new \ReflectionClass($serializable_class))
            ->getMethod('__construct')
            ->getParameters();

        $params = [];

        foreach($class_params as $class_param)
        {
            $class = $class_param->getClass()->name;
            $name = $class_param->name;

            $params[] = $class::deserialize($array[$name]);
        }

        $serializable_class = new \ReflectionClass($serializable_class);

        return $serializable_class->newInstanceArgs($params);
    }
}
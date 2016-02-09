<?php namespace BoundedContext\Serializable;

class AbstractSerializable
{
    public function serialize()
    {
        $class = new \ReflectionClass(get_called_class());
        $parameters = $class->getConstructor()->getParameters();

        $serialized = [];
        foreach ($parameters as $index => $parameter)
        {
            $name = $parameter->getName();
            $value = $this->$name;
            $serialized[$name] = $value->serialize();
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
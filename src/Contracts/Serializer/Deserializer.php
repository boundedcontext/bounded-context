<?php namespace BoundedContext\Contracts\Serializer;

use BoundedContext\Contracts\Core\Serializable;

interface Deserializer
{
    /**
     * Deserializes an Object.
     *
     * @param string $class
     * @param array|string $parameters
     *
     * @throws \Exception
     * @return Serializable
     */

    public function deserialize($class, $parameters = null);
}

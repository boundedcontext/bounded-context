<?php namespace BoundedContext\Contracts\Serializer;

use BoundedContext\Contracts\Core\Serializable;

interface Serializer
{
    /**
     * Serializes a ValueObject.
     *
     * @throws \Exception
     * @return array|string
     */

    public function serialize(Serializable $serializable);
}

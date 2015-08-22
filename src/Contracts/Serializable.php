<?php namespace BoundedContext\Contracts;

interface Serializable
{
    public function serialize();

    public static function deserialize($parameters = null);
}
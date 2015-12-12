<?php namespace BoundedContext\Contracts\Core;

interface Serializable
{
    public function serialize();

    public static function deserialize($parameters = null);
}
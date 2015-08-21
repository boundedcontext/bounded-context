<?php namespace BoundedContext\Contracts;

interface ValueObject
{
    public function toString();

    public function serialize();

    public static function deserialize($params);
}

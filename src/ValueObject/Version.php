<?php namespace BoundedContext\ValueObject;

use BoundedContext\Contracts\ValueObject;

class Version implements ValueObject
{
    private $version;

    public function __construct($version)
    {
        $this->version = $version;
    }

    public function toString()
    {
        return $this->version;
    }

    public function serialize()
    {
        return $this->toString();
    }

    public static function deserialize($version)
    {
        return new Version($version);
    }
}

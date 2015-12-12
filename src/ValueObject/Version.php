<?php namespace BoundedContext\ValueObject;

use BoundedContext\Contracts\ValueObject\ValueObject;

class Version implements ValueObject
{
    private $version;

    public function __construct($version = 0)
    {
        $this->version = $version;
    }

    public function increment()
    {
        $new_version = $this->serialize() + 1;

        return new Version($new_version);
    }

    public function serialize()
    {
        return $this->version;
    }

    public static function deserialize($version = 0)
    {
        return new Version($version);
    }
}

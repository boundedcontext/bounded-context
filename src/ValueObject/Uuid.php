<?php namespace BoundedContext\ValueObject;

use BoundedContext\Contracts\ValueObject;
use Rhumsaa\Uuid\Uuid as RhumsaaUuid;

class Uuid implements ValueObject
{
    private $uuid;

    public function __construct($uuid)
    {
        $this->uuid = RhumsaaUuid::fromString($uuid);
    }

    public function serialize()
    {
        return $this->uuid->toString();
    }

    public function equals(Uuid $other)
    {
        return ($this->serialize() == $other->serialize());
    }

    public static function generate()
    {
        return new Uuid(RhumsaaUuid::uuid4());
    }

    public static function deserialize($uuid = null)
    {
        return new Uuid(RhumsaaUuid::fromString($uuid));
    }
}

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

    public function toString()
    {
        return $this->uuid->toString();
    }

    public function serialize()
    {
        return $this->toString();
    }

    public function equals(Uuid $other)
    {
        return ($this->toString() == $other->toString());
    }

    public static function generate()
    {
        return new Uuid(RhumsaaUuid::uuid4());
    }

    public static function deserialize($uuid)
    {
        return new Uuid(RhumsaaUuid::fromString($uuid));
    }
}

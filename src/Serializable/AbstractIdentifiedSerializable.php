<?php namespace BoundedContext\Serializable;

use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\ValueObject\ValueObject;
use BoundedContext\Contracts\ValueObject\Identifier;

class AbstractIdentifiedSerializable extends AbstractSerializable implements Identifiable
{
    protected $id;

    public function __construct(Identifier $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }

    public function equals(ValueObject $other)
    {
        return ($this->serialize() === $other->serialize());
    }

    public function serialize()
    {
        $serialized = parent::serialize();
        $serialized['id'] = $this->id->serialize();

        return $serialized;
    }
}
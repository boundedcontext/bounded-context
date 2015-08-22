<?php namespace BoundedContext\Serializable;

use BoundedContext\Contracts\Identifiable;
use BoundedContext\ValueObject\Uuid;

class AbstractIdentifiedSerializable extends AbstractSerializable implements Identifiable
{
    protected $id;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }

    public function serialize()
    {
        $serialized = parent::serialize();
        $serialized['id'] = $this->id->serialize();

        return $serialized;
    }
}
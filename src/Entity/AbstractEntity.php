<?php namespace BoundedContext\Entity;

use BoundedContext\Contracts\Entity\Entity;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Serializable\AbstractSerializable;

class AbstractEntity extends AbstractSerializable
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

    public function equals(Entity $other)
    {
        return ($this->id === $other->id());
    }

}

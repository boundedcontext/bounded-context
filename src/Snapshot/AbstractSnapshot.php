<?php namespace BoundedContext\Snapshot;

use BoundedContext\Contracts\ValueObject\DateTime;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\ValueObject\AbstractValueObject;
use BoundedContext\ValueObject\Integer;

abstract class AbstractSnapshot extends AbstractValueObject
{
    public $id;
    public $version;
    public $occurred_at;

    public function __construct(
        Identifier $id,
        Integer $version,
        DateTime $occurred_at
    )
    {
        $this->id = $id;
        $this->version = $version;
        $this->occurred_at = $occurred_at;
    }

    public function id()
    {
        return $this->id;
    }

    public function version()
    {
        return $this->version;
    }

    public function occurred_at()
    {
        return $this->occurred_at;
    }
}

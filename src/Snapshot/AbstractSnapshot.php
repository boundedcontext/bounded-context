<?php namespace BoundedContext\Snapshot;

use BoundedContext\ValueObject\AbstractValueObject;
use BoundedContext\ValueObject\Integer;

abstract class AbstractSnapshot extends AbstractValueObject
{
    public $version;

    public function __construct(Integer $version)
    {
        $this->version = $version;
    }
}

<?php namespace BoundedContext\Sourced\Aggregate\State;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Contracts\Projection\Projection;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Event\Applying;
use BoundedContext\ValueObject\AbstractValueObject;
use BoundedContext\ValueObject\Integer as Version;

abstract class AbstractState extends AbstractValueObject implements State
{
    use Applying;

    protected $id;

    public function __construct(
        Identifier $id,
        Version $version,
        Projection $projection
    )
    {
        $this->id = $id;
        $this->version = $version;
        $this->projection = $projection;
    }

    public function id()
    {
        return $this->id;
    }

    public function version()
    {
        return $this->version;
    }

    public function apply(Event $event)
    {
        $this->mutate($event);
    }

    public function queryable()
    {
        return $this->projection;
    }
}

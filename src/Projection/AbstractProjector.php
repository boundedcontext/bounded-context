<?php namespace BoundedContext\Projection;

use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Contracts\Generator\DateTime as DateTimeGenerator;
use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Sourced\Log\Log;
use BoundedContext\Contracts\Projection\Projection;
use BoundedContext\Player\AbstractPlayer;
use BoundedContext\Player\Snapshot\Snapshot;

abstract class AbstractProjector extends AbstractPlayer implements \BoundedContext\Contracts\Projection\Projector
{
    protected $projection;

    public function __construct(
        IdentifierGenerator $identifier_generator,
        DateTimeGenerator $datetime_generator,
        Projection $projection,
        Log $log,
        Snapshot $snapshot
    )
    {
        parent::__construct(
            $identifier_generator,
            $datetime_generator,
            $log,
            $snapshot
        );

        $this->projection = $projection;
    }

    private function mutate($function, Event $event, Snapshot $snapshot)
    {
        $this->$function(
            $this->projection,
            $event,
            $snapshot
        );
    }

    public function projection()
    {
        return $this->projection;
    }

    public function queryable()
    {
        return $this->projection->queryable();
    }
}

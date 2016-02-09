<?php namespace BoundedContext\Projection;

use BoundedContext\Contracts\Player\Snapshot\Snapshot;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Contracts\Generator\DateTime as DateTimeGenerator;
use BoundedContext\Contracts\Event\Factory as EventFactory;
use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Event\Snapshot\Snapshot as EventSnapshot;
use BoundedContext\Contracts\Sourced\Log\Log;
use BoundedContext\Contracts\Projection\Projection;
use BoundedContext\Player\AbstractPlayer;

abstract class AbstractProjector extends AbstractPlayer implements \BoundedContext\Contracts\Projection\Projector
{
    protected $projection;

    public function __construct(
        Projection $projection,
        IdentifierGenerator $identifier_generator,
        DateTimeGenerator $datetime_generator,
        EventFactory $event_factory,
        Log $log,
        Snapshot $snapshot
    )
    {
        parent::__construct(
            $identifier_generator,
            $datetime_generator,
            $event_factory,
            $log,
            $snapshot
        );

        $this->projection = $projection;
    }

    protected function mutate(Event $event, EventSnapshot $snapshot)
    {
        $handler = $this->get_handler_name($event);

        $this->$handler(
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

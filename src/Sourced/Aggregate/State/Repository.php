<?php namespace BoundedContext\Sourced\Aggregate\State;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\Event\Snapshot\Stream;
use BoundedContext\Contracts\Sourced\Aggregate\Factory as AggregateFactory;
use BoundedContext\Contracts\Event\Snapshot\Factory as EventSnapshotFactory;
use BoundedContext\Contracts\Sourced\Aggregate\State\Repository as StateRepository;
use BoundedContext\Contracts\Event\Factory as EventFactory;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Contracts\Sourced\Log\Log;

class Repository implements \BoundedContext\Contracts\Sourced\Aggregate\State\Repository
{
    private $state_repository;
    private $aggregate_factory;
    private $event_snapshot_factory;
    private $event_factory;
    private $event_snapshot_stream;
    private $log;

    public function __construct(
        StateRepository $state_repository,
        AggregateFactory $aggregate_factory,
        EventSnapshotFactory $event_snapshot_factory,
        EventFactory $event_factory,
        Stream $event_snapshot_stream,
        Log $log
    )
    {
        $this->state_repository = $state_repository;
        $this->aggregate_factory = $aggregate_factory;
        $this->event_snapshot_factory = $event_snapshot_factory;
        $this->event_factory = $event_factory;
        $this->event_snapshot_stream = $event_snapshot_stream;
        $this->log = $log;
    }

    public function by_command(Command $command)
    {
        $state_snapshot = $this->snapshot_repository->by_command($command);

        return $this->state_factory->snapshot($state_snapshot);
    }

    public function save(State $state)
    {
        $this->snapshot_repository->save(
            $this->snapshot_factory->state($state)
        );
    }
}

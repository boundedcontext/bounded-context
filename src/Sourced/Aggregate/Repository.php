<?php namespace BoundedContext\Sourced\Aggregate;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\Event\Factory as EventFactory;
use BoundedContext\Contracts\Event\Snapshot\Factory as EventSnapshotFactory;
use BoundedContext\Contracts\Sourced\Aggregate\Factory as AggregateFactory;
use BoundedContext\Contracts\Sourced\Aggregate\Aggregate;
use BoundedContext\Contracts\Sourced\Log\Log as EventLog;
use BoundedContext\Contracts\Sourced\Aggregate\State\Factory as StateFactory;
use BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Factory as StateSnapshotFactory;
use BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Repository as StateSnapshotRepository;

class Repository implements \BoundedContext\Contracts\Sourced\Aggregate\Repository
{
    private $state_snapshot_repository;
    private $state_snapshot_factory;
    private $state_factory;
    private $aggregate_factory;
    private $event_snapshot_factory;
    private $event_factory;
    private $event_log;

    public function __construct(
        StateSnapshotRepository $state_snapshot_repository,
        StateSnapshotFactory $state_snapshot_factory,
        StateFactory $state_factory,
        AggregateFactory $aggregate_factory,
        EventSnapshotFactory $event_snapshot_factory,
        EventFactory $event_factory,
        EventLog $event_log
    )
    {
        $this->state_snapshot_repository = $state_snapshot_repository;
        $this->state_snapshot_factory = $state_snapshot_factory;
        $this->state_factory = $state_factory;

        $this->aggregate_factory = $aggregate_factory;

        $this->event_snapshot_factory = $event_snapshot_factory;
        $this->event_factory = $event_factory;
        $this->event_log = $event_log;
    }

    public function by(Command $command)
    {
        $state = $this->state_factory
            ->with($command)
            ->snapshot(
            $this->state_snapshot_repository->id(
                $command->id()
            )
        );

        $event_snapshots = $this->event_log
            ->stream()
            ->after($state->version())
            ->with($state->id())
            ->as_collection();

        foreach($event_snapshots as $event_snapshot)
        {
            $state->apply(
                $this->event_factory->snapshot($event_snapshot)
            );
        }

        return $this->aggregate_factory->state($state);
    }

    public function save(Aggregate $aggregate)
    {
        $this->state_snapshot_repository->save(
            $this->state_snapshot_factory->state(
                $aggregate->state()
            )
        );

        $this->event_log->append_collection(
            $this->event_snapshot_factory->collection(
                $aggregate->changes()
            )
        );

        $aggregate->flush();
    }
}

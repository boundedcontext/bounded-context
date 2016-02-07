<?php namespace BoundedContext\Sourced\Aggregate;

use BoundedContext\Contracts\Command\Command;

use BoundedContext\Contracts\Sourced\Log\Log as EventLog;

use BoundedContext\Contracts\Sourced\Aggregate\Aggregate;
use BoundedContext\Contracts\Sourced\Aggregate\Factory as AggregateFactory;

use BoundedContext\Contracts\Sourced\Aggregate\Stream\Builder as AggregateStreamBuilder;

use BoundedContext\Contracts\Sourced\Aggregate\State\Factory as StateFactory;
use BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Factory as StateSnapshotFactory;
use BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Repository as StateSnapshotRepository;

class Repository implements \BoundedContext\Contracts\Sourced\Aggregate\Repository
{
    private $state_snapshot_repository;
    private $state_snapshot_factory;
    private $state_factory;

    private $aggregate_factory;
    private $aggregate_stream_builder;

    private $event_log;

    public function __construct(
        StateSnapshotRepository $state_snapshot_repository,
        StateSnapshotFactory $state_snapshot_factory,
        StateFactory $state_factory,
        AggregateFactory $aggregate_factory,
        AggregateStreamBuilder $aggregate_stream_builder,
        EventLog $event_log
    )
    {
        $this->state_snapshot_repository = $state_snapshot_repository;
        $this->state_snapshot_factory = $state_snapshot_factory;
        $this->state_factory = $state_factory;

        $this->aggregate_factory = $aggregate_factory;

        $this->aggregate_stream_builder = $aggregate_stream_builder;
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
            )
        ;

        $event_stream = $this->aggregate_stream_builder
            ->with($state->id())
            ->after($state->version())
            ->stream();

        foreach($event_stream as $event)
        {
            $state->apply($event);
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
            $aggregate->changes()
        );

        $aggregate->flush();
    }
}

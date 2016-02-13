<?php namespace BoundedContext\Player;

use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Contracts\Generator\DateTime as DateTimeGenerator;
use BoundedContext\Contracts\Player\Player;
use BoundedContext\Contracts\Sourced\Log\Log;
use BoundedContext\Contracts\Player\Snapshot\Snapshot;

use BoundedContext\Contracts\Event\Factory as EventFactory;
use BoundedContext\Event\Snapshot\Snapshot as EventSnapshot;
use BoundedContext\ValueObject\Integer;

abstract class AbstractPlayer implements Player
{
    use Playing;

    protected $identifier_generator;
    protected $datetime_generator;
    protected $event_factory;
    protected $log;
    protected $snapshot;

    public function __construct(
        IdentifierGenerator $identifier_generator,
        DateTimeGenerator $datetime_generator,
        EventFactory $event_factory,
        Log $log,
        Snapshot $snapshot
    )
    {
        $this->identifier_generator = $identifier_generator;
        $this->datetime_generator = $datetime_generator;
        $this->event_factory = $event_factory;
        $this->log = $log;
        $this->snapshot = $snapshot;
    }

    public function reset()
    {
        $this->snapshot = $this->snapshot->reset(
            $this->identifier_generator,
            $this->datetime_generator
        );
    }

    public function play($limit = 1000)
    {
        $snapshot_stream = $this->log
            ->builder()
            ->after($this->snapshot()->last_id())
            ->limit(new Integer($limit))
            ->stream();

        foreach($snapshot_stream as $snapshot)
        {
            $this->apply($snapshot);
        }
    }

    protected function apply(EventSnapshot $snapshot)
    {
        $event = $this->event_factory->snapshot($snapshot);

        if (!$this->can_apply($event))
        {
            $this->snapshot = $this->snapshot->skip(
                $snapshot->id(),
                $this->datetime_generator
            );

            return true;
        }

        $this->mutate($event, $snapshot);

        $this->snapshot = $this->snapshot->take(
            $snapshot->id(),
            $this->datetime_generator
        );
    }

    public function snapshot()
    {
        return $this->snapshot;
    }
}

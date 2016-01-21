<?php namespace BoundedContext\Player;

use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Contracts\Generator\DateTime as DateTimeGenerator;
use BoundedContext\Contracts\Player\Player;
use BoundedContext\Contracts\Sourced\Log\Log;
use BoundedContext\Player\Snapshot\Snapshot;
use BoundedContext\Stream\Stream;

abstract class AbstractPlayer implements Player
{
    use Playing;

    protected $identifier_generator;
    protected $datetime_generator;
    protected $log;
    protected $snapshot;

    public function __construct(
        IdentifierGenerator $identifier_generator,
        DateTimeGenerator $datetime_generator,
        Log $log,
        Snapshot $snapshot
    )
    {
        $this->identifier_generator = $identifier_generator;
        $this->datetime_generator = $datetime_generator;
        $this->log = $log;
        $this->snapshot = $snapshot;
    }

    public function reset()
    {
        $this->snapshot->reset(
            $this->identifier_generator,
            $this->datetime_generator
        );
    }

    public function play($limit = 1000)
    {
        $stream = new Stream(
            $this->log,
            $this->snapshot->last_id(),
            $limit
        );

        while($stream->has_next())
        {
            $this->snapshot = $this->apply(
                $stream->next()
            );
        }
    }

    public function snapshot()
    {
        return $this->snapshot;
    }
}

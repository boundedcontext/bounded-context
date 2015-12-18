<?php namespace BoundedContext\Player;

use BoundedContext\Contracts\Player\Player;
use BoundedContext\Contracts\Sourced\Log;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Stream\Stream;
use BoundedContext\ValueObject\Integer;

abstract class AbstractPlayer implements Player
{
    use Playing;

    protected $log;
    protected $snapshot;

    public function __construct(Log $log, Snapshot $snapshot)
    {
        $this->log = $log;
        $this->snapshot = $snapshot;
    }

    public function reset(IdentifierGenerator $generator)
    {
        $this->snapshot = new Snapshot(
            $generator->null(),
            new Integer(0)
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

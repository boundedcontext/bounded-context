<?php namespace BoundedContext\Projector;

use BoundedContext\Contracts\Sourced\Log;
use BoundedContext\Contracts\Projection\Projection;
use BoundedContext\Contracts\Projection\Projector;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Stream\Stream;
use BoundedContext\ValueObject\Integer;

abstract class AbstractProjector implements Projector
{
    use Projecting;

    protected $log;
    protected $projection;

    protected $last_id;
    protected $version;
    protected $count;

    public function __construct(
        Log $log,
        Projection $projection,
        Identifier $last_id,
        Integer $version,
        Integer $count
    )
    {
        $this->log = $log;
        $this->projection = $projection;

        $this->last_id = $last_id;
        $this->version = $version;
        $this->count = $count;
    }

    public function version()
    {
        return $this->version;
    }

    public function last_id()
    {
        return $this->last_id;
    }

    public function count()
    {
        return $this->count;
    }

    public function reset(IdentifierGenerator $generator)
    {
        $this->projection->reset($generator);

        $this->last_id = $generator->null();
        $this->version = new Integer(0);
        $this->count = new Integer(0);
    }

    public function play($limit = 1000)
    {
        $stream = new Stream($this->log, $this->last_id, $limit);

        while($stream->has_next())
        {
            $item = $stream->next();
            $this->apply($item);
        }
    }

    public function projection()
    {
        return $this->projection;
    }
}

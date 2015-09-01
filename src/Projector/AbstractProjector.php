<?php namespace BoundedContext\Projector;

use BoundedContext\Contracts\Log;
use BoundedContext\Contracts\Projection;
use BoundedContext\Contracts\Projector;
use BoundedContext\Stream\Stream;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\ValueObject\Version;

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
        Uuid $last_id,
        Version $version,
        Version $count
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

    public function reset()
    {
        $this->projection->reset();

        $this->last_id = Uuid::null();
        $this->version = new Version(0);
        $this->count = new Version(0);
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

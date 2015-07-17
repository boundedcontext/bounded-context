<?php namespace BoundedContext\Event\Projector;

use BoundedContext\Event\Projectable;
use BoundedContext\Event\Log\Stream\Stream;

abstract class AbstractProjector implements Projector
{

    use Projecting;

    protected $stream;
    protected $projection;
    protected $version;

    public function __construct(Stream $stream)
    {
        $this->stream = $stream;
        $this->projection = null;

        $this->version = 0;

        $this->set_projection();
    }

    public function play()
    {
        while ($this->stream->has_next()) {
            $event = $this->stream->next();

            $this->mutate(
                $event
            );
        }
    }

    public function apply(Projectable $p)
    {
        $this->play();

        $this->mutate(
            $p
        );
    }

    public function state()
    {
        return $this->projection;
    }
}

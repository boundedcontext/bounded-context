<?php namespace BoundedContext\Workflow;

use BoundedContext\Contracts\Dispatcher;
use BoundedContext\Contracts\Log;
use BoundedContext\Contracts\Workflow;
use BoundedContext\Stream\Stream;
use BoundedContext\ValueObject\Uuid;

abstract class AbstractWorkflow implements Workflow
{
    use Working;

    protected $log;
    protected $bus;
    protected $last_id;

    public function __construct(Log $log, Dispatcher $bus, Uuid $last_id)
    {
        $this->log = $log;
        $this->bus = $bus;
        $this->last_id = $last_id;
    }

    public function last_id()
    {
        return $this->last_id;
    }

    public function reset()
    {
        $this->last_id = Uuid::null();
    }

    public function play()
    {
        $stream = new Stream($this->log, $this->last_id);

        while($stream->has_next())
        {
            $item = $stream->next();

            $this->apply($item);
        }
    }
}

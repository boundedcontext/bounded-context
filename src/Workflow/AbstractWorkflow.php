<?php namespace BoundedContext\Workflow;

use BoundedContext\Contracts\Bus\Dispatcher;
use BoundedContext\Contracts\Sourced\Log;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Contracts\Workflow\Workflow;
use BoundedContext\Stream\Stream;

abstract class AbstractWorkflow implements Workflow
{
    use Working;

    protected $log;
    protected $bus;
    protected $last_id;

    public function __construct(Log $log, Dispatcher $bus, Identifier $last_id)
    {
        $this->log = $log;
        $this->bus = $bus;
        $this->last_id = $last_id;
    }

    public function last_id()
    {
        return $this->last_id;
    }

    public function reset(IdentifierGenerator $generator)
    {
        $this->last_id = $generator->null();
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
}

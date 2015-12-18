<?php namespace BoundedContext\Workflow;

use BoundedContext\Contracts\Bus\Dispatcher;
use BoundedContext\Contracts\Sourced\Log;
use BoundedContext\Player\AbstractPlayer;
use BoundedContext\Player\Snapshot;

class AbstractWorkflow extends AbstractPlayer
{
    protected $bus;

    public function __construct(Log $log, Dispatcher $bus, Snapshot $snapshot)
    {
        parent::__construct($log, $snapshot);

        $this->bus = $bus;
    }
}

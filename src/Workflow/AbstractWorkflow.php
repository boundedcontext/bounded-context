<?php namespace BoundedContext\Workflow;

use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Contracts\Generator\DateTime as DateTimeGenerator;
use BoundedContext\Contracts\Bus\Dispatcher;
use BoundedContext\Contracts\Event\Log;
use BoundedContext\Contracts\Player\Snapshot\Snapshot;

use BoundedContext\Player\AbstractPlayer;

class AbstractWorkflow extends AbstractPlayer
{
    protected $bus;

    public function __construct(
        IdentifierGenerator $identifier_generator,
        DateTimeGenerator $datetime_generator,
        Log $log,
        Dispatcher $bus,
        Snapshot $snapshot
    )
    {
        parent::__construct(
            $identifier_generator,
            $datetime_generator,
            $log,
            $snapshot
        );

        $this->bus = $bus;
    }
}

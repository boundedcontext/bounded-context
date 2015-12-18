<?php namespace BoundedContext\Projector;

use BoundedContext\Contracts\Sourced\Log;
use BoundedContext\Contracts\Projection\Projection;
use BoundedContext\Player\AbstractPlayer;
use BoundedContext\Player\Snapshot;

class Projector extends AbstractPlayer implements \BoundedContext\Contracts\Projector\Projector
{
    protected $projection;

    public function __construct(
        Projection $projection,
        Log $log,
        Snapshot $snapshot
    )
    {
        parent::__construct($log, $snapshot);

        $this->projection = $projection;
    }

    public function projection()
    {
        return $this->projection;
    }
}

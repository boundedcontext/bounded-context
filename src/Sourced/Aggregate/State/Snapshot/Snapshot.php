<?php namespace BoundedContext\Sourced\Aggregate\State\Snapshot;

use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Contracts\ValueObject\DateTime;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Snapshot\AbstractSnapshot;
use BoundedContext\ValueObject\Integer as Version;

class Snapshot extends AbstractSnapshot implements \BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Snapshot
{
    private $state;

    public function __construct(
        Identifier $id,
        Version $version,
        DateTime $occurred_at,
        State $state
    )
    {
        parent::__construct($id, $version, $occurred_at);

        $this->state = $state;
    }

    public function state()
    {
        return $this->state;
    }
}

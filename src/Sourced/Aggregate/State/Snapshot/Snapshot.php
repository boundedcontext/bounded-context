<?php namespace BoundedContext\Sourced\Aggregate\State\Snapshot;

use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\Contracts\ValueObject\DateTime;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Snapshot\AbstractSnapshot;
use BoundedContext\ValueObject\Integer;

class Snapshot extends AbstractSnapshot implements \BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Snapshot
{
    private $schema;

    public function __construct(
        Identifier $id,
        Integer $version,
        DateTime $occurred_at,
        Schema $schema
    )
    {
        parent::__construct($id, $version, $occurred_at);

        $this->schema = $schema;
    }

    public function schema()
    {
        return $this->schema;
    }
}

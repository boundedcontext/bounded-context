<?php namespace BoundedContext\Sourced\Aggregate\State\Snapshot;

use BoundedContext\Contracts\ValueObject\DateTime;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Schema\Schema;
use BoundedContext\Snapshot\AbstractSnapshot;
use BoundedContext\ValueObject\Integer as Version;

class Snapshot extends AbstractSnapshot implements \BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Snapshot
{
    private $schema;

    public function __construct(
        Identifier $id,
        Version $version,
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

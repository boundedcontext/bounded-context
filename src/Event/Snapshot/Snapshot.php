<?php namespace BoundedContext\Event\Snapshot;

use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\Contracts\ValueObject\DateTime;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Snapshot\AbstractSnapshot;
use BoundedContext\ValueObject\Integer as Integer_;

class Snapshot extends AbstractSnapshot implements \BoundedContext\Contracts\Event\Snapshot\Snapshot
{
    protected $type_id;
    protected $event;

    public function __construct(
        Identifier $id,
        Integer_ $version,
        DateTime $occurred_at,
        Identifier $type_id,
        Schema $event
    )
    {
        parent::__construct($id, $version, $occurred_at);

        $this->type_id = $type_id;
        $this->event = $event;
    }

    public function type_id()
    {
        return $this->type_id;
    }

    public function schema()
    {
        return $this->event;
    }
}

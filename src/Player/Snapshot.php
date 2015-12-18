<?php namespace BoundedContext\Player;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Snapshot\AbstractSnapshot;
use BoundedContext\ValueObject\Integer;

class Snapshot extends AbstractSnapshot implements \BoundedContext\Contracts\Core\Snapshot\Snapshot
{
    public $last_id;

    public function __construct(Identifier $last_id, Integer $version)
    {
        parent::__construct($version);

        $this->last_id = $last_id;
    }

    public function last_id()
    {
        return $this->last_id;
    }

    public function skip(Identifier $next_id)
    {
        return new Snapshot(
            $next_id,
            $this->version
        );
    }

    public function take(Identifier $next_id)
    {
        return new Snapshot(
            $next_id,
            $this->version->increment()
        );
    }
}

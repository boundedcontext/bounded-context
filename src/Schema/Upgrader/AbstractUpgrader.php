<?php namespace BoundedContext\Schema\Upgrader;
use BoundedContext\Schema\Snapshot;

abstract class AbstractUpgrader
{
    use Upgrading;

    private $snapshot;

    public function __construct(Snapshot $snapshot)
    {
        $this->snapshot = $snapshot;

        if($snapshot->version()->serialize() == 0)
        {
            $this->snapshot = new Snapshot(
                $this->snapshot->schema()->add('id'),
                $snapshot->version()->increment()
            );
        }

        while($this->can_upgrade())
        {
            $this->upgrade();
        }
    }

    public function snapshot()
    {
        return $this->snapshot;
    }
}

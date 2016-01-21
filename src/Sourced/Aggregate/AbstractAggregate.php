<?php namespace BoundedContext\Sourced\Aggregate;

use BoundedContext\Contracts\Business\Invariant\Factory as InvariantFactory;
use BoundedContext\Contracts\Event\Factory as EventFactory;
use BoundedContext\Contracts\Sourced\Aggregate\Aggregate;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Collection\Collection;

abstract class AbstractAggregate implements Aggregate
{
    protected $invariant_factory;
    protected $event_factory;

    protected $state;
    protected $changes;

    public function __construct(
        InvariantFactory $invariant_factory,
        EventFactory $event_factory,
        State $state
    )
    {
        $this->invariant_factory = $invariant_factory;
        $this->event_factory = $event_factory;

        $this->state = $state;
        $this->changes = new Collection();
    }

    protected function assert($class, $params = [])
    {
        $invariant = $this->invariant_factory->by_class($class, $params);

        $invariant->assert();

        return true;
    }

    protected function is_satisfied($class, $params = [])
    {
        $invariant = $this->invariant_factory->by_class($class, $params);

        return $invariant->is_satisfied();
    }

    protected function apply($class, $params = [])
    {
        $event = $this->event_factory->by_class($class, $params);

        $this->state->apply($event);
        $this->changes->append($event);
    }

    public function state()
    {
        return $this->state;
    }

    public function changes()
    {
        return $this->changes;
    }
    
    public function flush()
    {
        $this->changes = new Collection();
    }
}

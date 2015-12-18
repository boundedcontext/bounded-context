<?php namespace BoundedContext\Aggregate;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Sourced\Aggregate;
use BoundedContext\Contracts\Sourced\State;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Collection\Collection;

abstract class AbstractAggregate implements Aggregate
{
    protected $id;
    protected $state;
    protected $changes;

    public function __construct(Identifier $id, State $state)
    {
        $this->id = $id;
        $this->state = $state;

        $this->changes = new Collection();
    }

    private function check_event_belongs(Event $event)
    {
        if(!$event->id()->equals($this->id))
        {
            throw new \Exception("
            Event [".get_class($event)."] ".$event->id()->serialize().
                " does not belong to Aggregate ".
                $this->id()->serialize().
                "."
            );
        }
    }

    public function id()
    {
        return $this->id;
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

    protected function apply(Event $event)
    {
        $this->check_event_belongs($event);

        $this->state->apply($event);
        $this->changes->append($event);
    }
}

<?php namespace BoundedContext\Sourced\Aggregate;

use BoundedContext\Contracts\Business\Invariant\Factory;
use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Command\Handling;
use BoundedContext\Collection\Collection;

abstract class AbstractAggregate
{
    use Handling;

    protected $state;
    protected $changes;

    protected $assert;
    protected $check;

    public function __construct(Factory $invariant_factory, State $state)
    {
        $this->state = $state;
        $this->changes = new Collection();

        $this->assert = new Assertion($invariant_factory, $state);
        $this->check = new Check($invariant_factory, $state);
    }

    public function handle(Command $command)
    {
        $this->mutate($command);
    }

    protected function apply(Event $event)
    {
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

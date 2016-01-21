<?php namespace BoundedContext\Player;

use BoundedContext\Contracts\Generator\DateTime as DateTimeGenerator;
use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Event\Factory;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;

trait Playing
{

    /**
     * @var DateTimeGenerator $datetime_generator
     */
    protected $datetime_generator;

    /**
     * @var \BoundedContext\Player\Snapshot\Snapshot $snapshot
     */
    protected $snapshot;

    /**
     * @var Factory $event_factory
     */
    protected $event_factory;

    private function from_camel_case($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);

        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }

    private function get_function_name(Event $e)
    {
        $reflect = new \ReflectionClass($e);
        $class_name = $reflect->getShortName();

        $namespaced_class = get_class($e);
        $words = preg_split('#[\\\.]#', $namespaced_class, -1, PREG_SPLIT_NO_EMPTY);

        return 'when_' . strtolower($words[1]) . '_' . strtolower($words[3]) . '_' . $this->from_camel_case($class_name);
    }

    protected function can_apply(Event $event)
    {
        $function = $this->get_function_name($event);

        return method_exists($this, $function);
    }

    private function mutate($function, Event $event, Snapshot $snapshot)
    {
        $this->$function($event, $snapshot);
    }

    protected function apply(Snapshot $event_snapshot)
    {
        $event = $this->event_factory->snapshot($event_snapshot);

        if (!$this->can_apply($event))
        {
            return $this->snapshot->skip(
                $event_snapshot->id(),
                $this->datetime_generator
            );
        }

        $this->mutate(
            $this->get_function_name($event),
            $event,
            $event_snapshot
        );

        return $this->snapshot->take(
            $event_snapshot->id(),
            $this->datetime_generator
        );
    }
}

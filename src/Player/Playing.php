<?php namespace BoundedContext\Player;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;

trait Playing
{
    private function from_camel_case($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match)
        {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    protected function get_handler_name(Event $event)
    {
        $reflect = new \ReflectionClass($event);
        $namespace_path_items = preg_split(
            '#[\\\.]#',
            get_class($event),
            -1,
            PREG_SPLIT_NO_EMPTY
        );
        return 'when_'
        . strtolower($namespace_path_items[1])
        . '_'
        . strtolower($namespace_path_items[3])
        . '_'
        . $this->from_camel_case(
            $reflect->getShortName()
        )
            ;
    }

    protected function can_apply(Event $event)
    {
        $function = $this->get_handler_name($event);

        return method_exists($this, $function);
    }

    protected function mutate(Event $event, Snapshot $snapshot)
    {
        $handler = $this->get_handler_name($event);

        $this->$handler($event, $snapshot);
    }
}

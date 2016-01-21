<?php namespace BoundedContext\Sourced\Aggregate\State;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Serializable\AbstractSerializable;
use BoundedContext\ValueObject\Integer;

abstract class AbstractState extends AbstractSerializable implements State
{
    protected $id;
    protected $version;

    public function __construct(Identifier $id, Integer $version)
    {
        $this->id = $id;
        $this->version = $version;
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

        return 'when_' . $this->from_camel_case($class_name);
    }

    private function mutate(Event $event)
    {
        $function = $this->get_function_name($event);

        if (!method_exists($this, $function)) {
            throw new \Exception('An event handler could not be found.');
        }

        $this->$function($event);
    }

    public function id()
    {
        return $this->id;
    }

    public function version()
    {
        return $this->version();
    }

    public function apply(Event $event)
    {
        $this->check_event_belongs($event);
        $this->mutate($event);
        $this->version->increment();
    }
}

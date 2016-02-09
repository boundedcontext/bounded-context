<?php namespace BoundedContext\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Projection\Projection;
use BoundedContext\ValueObject\Integer;

trait Applying
{
    /**
     * @var Projection $projection;
     */
    protected $projection;

    /**
     * @var Integer $version
     */
    protected $version;

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

    private function get_handler_name(Event $event)
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

    protected function mutate(Event $event)
    {
        $handler = $this->get_handler_name($event);

        if(method_exists($this, $handler))
        {
            $this->$handler(
                $this->projection,
                $event
            );
        }

        $this->version = $this->version->increment();
    }
}

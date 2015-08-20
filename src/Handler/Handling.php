<?php namespace BoundedContext\Projector;

use BoundedContext\Handler\Handlable;

trait Handling
{

    private function from_camel_case($input)
    {

        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);

        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }

    private function get_function_name(Handlable $e)
    {

        $reflect = new \ReflectionClass($e);

        $class_name = $reflect->getShortName();

        return 'when_' . $this->from_camel_case($class_name);
    }

    private function mutate(Handlable $h)
    {

        $function = $this->get_function_name($h);

        if (!method_exists($this, $function)) {
            throw new \Exception('A handler could not be found.');
        }

        $this->$function($h);
    }

    public function can_apply(Handlable $h)
    {
        $function = $this->get_function_name($h);

        return method_exists($this, $function);
    }
}

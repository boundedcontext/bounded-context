<?php

namespace BoundedContext\Event\Projector;

use BoundedContext\Event\Projectable;

trait Projecting
{
	private function from_camel_case($input) {

		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);

		$ret = $matches[0];
		foreach ($ret as &$match) {
	    	$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
	  	}

	  	return implode('_', $ret);
	}

	private function get_function_name(Projectable $e) {

		$reflect = new \ReflectionClass($e);

		$class_name = $reflect->getShortName();

		return 'when_' . $this->from_camel_case($class_name);
	}

	private function mutate(Projectable $e) {
		
		$function = $this->get_function_name($e);

		if(!method_exists($this, $function)){
			throw new \Exception('An event handler could not be found.');
		}

		$this->$function($e);

		$this->version += 1;
	}

	public function can_apply(Projectable $e)
	{
		$function = $this->get_function_name($e);
		
		return method_exists($this, $function);
	}

	public function version()
	{
		return $this->version;
	}

	public function apply(Projectable $e)
	{
		$this->mutate($e);
	}
}

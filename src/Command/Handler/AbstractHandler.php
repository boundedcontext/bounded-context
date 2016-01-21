<?php namespace BoundedContext\Command\Handler;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\Command\Handler;
use BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Factory as SnapshotFactory;
use BoundedContext\Contracts\Sourced\Aggregate\Repository as AggregateRepository;
use BoundedContext\Contracts\Business\Invariant\Factory as InvariantFactory;
use BoundedContext\Contracts\Service\Factory as ServiceFactory;


abstract class AbstractHandler implements Handler
{
    protected $snapshot_factory;
	protected $aggregate_repository;
    protected $invariant_factory;
    protected $service_factory;

	public function __construct(
        SnapshotFactory $snapshot_factory,
        AggregateRepository $aggregate_repository,
        InvariantFactory $invariant_factory,
        ServiceFactory $service_factory
    )
	{
        $this->snapshot_factory = $snapshot_factory;
		$this->aggregate_repository = $aggregate_repository;
        $this->invariant_factory = $invariant_factory;
        $this->service_factory = $service_factory;
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

    protected function service($class)
    {
        return $this->service_factory->by_class($class);
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

	private function get_handler_name(Command $e)
	{
		$reflect = new \ReflectionClass($e);

		$class_name = $reflect->getShortName();

		return 'handle_' . $this->from_camel_case($class_name);
	}

	private function can_handle(Command $command)
	{
		$handler = $this->get_handler_name($command);

		return method_exists($this, $handler);
	}

	public function handle(Command $command)
	{
		if(!$this->can_handle($command))
		{
			throw new \Exception("Command [".get_class($command)."] does not have a hander.");
		}

        $aggregate = $this->aggregate_repository->by_snapshot(
            $this->snapshot_factory->command($command)
        );

        $handler = $this->get_handler_name($command);

        $this->$handler($aggregate, $command);

        $this->aggregate_repository->save($aggregate);
	}
}

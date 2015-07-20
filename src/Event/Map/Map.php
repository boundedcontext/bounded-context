<?php namespace BoundedContext\Event\Map;

use BoundedContext\Collection\Collection;

class Map
{

    private $routes;

    public function __construct(Collection $routes)
    {
        foreach ($routes as $route) {
            $id = $route->id()->toString();
            $this->routes[$id] = $route->class_namespace();
        }
    }

    public function lookup(Uuid $id)
    {
        $id_string = $id->toString();
        return $this->routes[$id_string];
    }
}

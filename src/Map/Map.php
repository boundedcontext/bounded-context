<?php namespace BoundedContext\Map;

use BoundedContext\Collection\Collection;

class Map
{

    private $id_routes;
    private $namespace_routes;

    public function __construct(Collection $routes)
    {
        foreach ($routes as $route) {
            $id = $route->id()->toString();
            $class_namespace = $route->class_namespace();
            
            $this->id_routes[$id] = $class_namespace;
            $this->namespace_routes[$class_namespace] = $id;
        }
    }

    public function lookup(Uuid $id)
    {
        $id_string = $id->toString();
        return $this->routes[$id_string];
    }
    
    public function reverse_lookup($class_namespace)
    {
        return $this->namespace_routes[$class_namespace];
    }
}

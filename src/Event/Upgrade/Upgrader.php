<?php namespace BoundedContext\Event\Upgrade;

use BoundedContext\Map\Map;

interface Upgrader
{
    public function __construct(Map $map, Item $item);
    
    public function run();
    
    public function event();
}

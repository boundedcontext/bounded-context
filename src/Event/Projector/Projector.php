<?php namespace BoundedContext\Event\Projector;

use BoundedContext\Versionable;
use BoundedContext\Event\Projectable;

interface Projector extends Versionable
{

    public function play();

    public function apply(Projectable $p);

    public function state();
}

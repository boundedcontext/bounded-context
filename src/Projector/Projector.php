<?php namespace BoundedContext\Projector;

use BoundedContext\Versionable;
use BoundedContext\Projector\Projectable;

interface Projector extends Versionable
{

    public function play();

    public function apply(Projectable $p);

    public function state();
}

<?php

namespace BoundedContext\Contracts;

use BoundedContext\Contracts\Core\Versionable;

interface Projector extends Versionable
{
    public function last_id();

    public function count();

    public function reset();

    public function play();

    public function projection();
}
<?php

namespace BoundedContext\Contracts;

use BoundedContext\Versionable;

interface Projector extends Versionable {

    public function last_id();

    public function reset();

    public function play();

    public function projection();
}
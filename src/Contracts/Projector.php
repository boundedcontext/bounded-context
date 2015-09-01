<?php

namespace BoundedContext\Contracts;

interface Projector extends Versionable
{
    public function last_id();

    public function count();

    public function reset();

    public function play();

    public function projection();
}
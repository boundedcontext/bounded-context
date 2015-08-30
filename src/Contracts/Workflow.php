<?php

namespace BoundedContext\Contracts;

interface Workflow
{
    public function last_id();

    public function reset();

    public function play();
}

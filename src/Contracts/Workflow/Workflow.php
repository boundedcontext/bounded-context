<?php

namespace BoundedContext\Contracts\Workflow;

interface Workflow
{
    public function last_id();

    public function reset();

    public function play();
}

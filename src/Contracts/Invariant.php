<?php

namespace BoundedContext\Contracts;

interface Invariant
{
    public function is_satisfied();

    public function assert();
}
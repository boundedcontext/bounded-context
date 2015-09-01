<?php

namespace BoundedContext\Contracts;

use BoundedContext\Collection\Collection;
use BoundedContext\ValueObject\Uuid;

interface Aggregate extends Identifiable, Versionable
{
    public function __construct(Uuid $id, State $state, Collection $collection);

    public function state();

    public function changes();

    public function flush();
}
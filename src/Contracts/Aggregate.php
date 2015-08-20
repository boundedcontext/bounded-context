<?php

namespace BoundedContext\Contracts;

use BoundedContext\Collection\Collection;
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Versionable;

interface Aggregate extends Identifiable, Versionable {

    public function __construct(Uuid $id, Collection $collection);

    public function state();

    public function changes();

    public function flush();
}

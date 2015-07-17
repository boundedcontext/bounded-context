<?php

namespace BoundedContext\Aggregate;

use BoundedContext\Identifiable;
use BoundedContext\Versionable;

interface Aggregate extends Identifiable, Versionable {

    public function __construct(Identity $id, Projector $projector);

    public function changes();
}

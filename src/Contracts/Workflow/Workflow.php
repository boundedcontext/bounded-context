<?php

namespace BoundedContext\Contracts\Workflow;

use BoundedContext\Contracts\Core\Playable;
use BoundedContext\Contracts\Core\ResetableByGenerator;

interface Workflow extends ResetableByGenerator, Playable
{

}

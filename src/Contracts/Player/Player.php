<?php namespace BoundedContext\Contracts\Player;

use BoundedContext\Contracts\Core\Playable;
use BoundedContext\Contracts\Core\ResetableByGenerator;
use BoundedContext\Contracts\Core\Snapshotable;

interface Player extends ResetableByGenerator, Playable, Snapshotable
{

}

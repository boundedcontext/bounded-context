<?php namespace BoundedContext\Contracts\Player;

use BoundedContext\Contracts\Core\Playable;
use BoundedContext\Contracts\Core\Resetable;
use BoundedContext\Contracts\Core\Snapshotable;

interface Player extends Resetable, Playable, Snapshotable
{

}

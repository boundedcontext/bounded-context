<?php namespace BoundedContext\Command;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Serializable\AbstractIdentifiedSerializable;

class AbstractCommand extends AbstractIdentifiedSerializable implements Command
{

}

<?php
require 'vendor/autoload.php';
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Map\Map;
use BoundedContext\Map\Route;
use BoundedContext\Collection\Collection;
use BoundedContext\Log;
use Illuminate\Database\Capsule\Manager as Capsule;
use BoundedContext\Examples\Recruitment\Aggregate\User\Command;
use BoundedContext\Log\Appendable;

class GenericAppendable implements Appendable
{

    public $id;
    public $item;

    public function __construct(Uuid $id, $item)
    {
        $this->id = $id;
        $this->item = $item;
    }

    public function id()
    {
        return $this->id;
    }

    public function to_array()
    {
        return [
            'id' => $this->id->toString(),
            'item' => $this->item
        ];
    }
}

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'bounded_context',
    'username' => 'homestead',
    'password' => 'secret',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$map = new Map(new Collection([
    new Route(
        new Uuid('c9dca633-2dce-487c-aca8-5e507ff54fb6'), 'BoundedContext\Examples\Recruitment\Aggregate\User\Event\Created', 1
    ),
    new Route(new Uuid('94cc2178-cf91-4b49-add0-f5df5a2a16b4'), 'BoundedContext\Examples\Recruitment\Aggregate\User\Event\Deleted', 1),
    new Route(new Uuid('cd712a9c-e84d-4cbf-8107-77fb2884430a'), 'BoundedContext\Examples\Recruitment\Aggregate\User\Event\PasswordChanged', 1),
    new Route(new Uuid('9ee26576-2a39-4080-a252-626651f5e716'), 'BoundedContext\Examples\Recruitment\Aggregate\User\Event\Undeleted', 1),
    new Route(new Uuid('e241decc-b8cc-4d28-8afa-f235c7422321'), 'BoundedContext\Examples\Recruitment\Aggregate\User\Event\UserNameChanged', 1),
    new Route(new Uuid('e241decc-b8cc-4d28-8afa-f235c7422322'), 'GenericAppendable', 1),
    ]));

$log = new Log\Adapter\Illuminate(
    $map, $capsule
);

$aggregate_id = Uuid::generate();

$log->append_collection(new Collection(array(
    new GenericAppendable($aggregate_id, 'D'),
    new GenericAppendable($aggregate_id, 'E'),
    new GenericAppendable($aggregate_id, 'F')
)));

/* $stream = new Stream\Adapter\Illuminate(
  $map, $capsule
  ); */

$command = new Command\Create(Uuid::generate(), 'lyonscf', 'password');

//$command_handler = new Handler($repository);
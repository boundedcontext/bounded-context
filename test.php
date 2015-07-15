<?

require 'vendor/autoload.php';

use BoundedContext\Collection;

use BoundedContext\Examples\Recruitment\Aggregate\User;
use BoundedContext\Examples\Recruitment\Aggregate\User\Event;
use BoundedContext\Examples\Recruitment\Aggregate\User\Projection;

use Rhumsaa\Uuid\Uuid as RhumsaaUuid;
use BoundedContext\Uuid;

$user_id = new Uuid(RhumsaaUuid::uuid4());

$events = new Collection([
	new Event\Created(
		$user_id->toString(),
		'lyonscf',
		'password'
	),
	new Event\PasswordChanged(
		$user_id->toString(),
		'password1'
	)
]);

$projector = new Projection\State\Projector(
	$events,
	new Projection\State\Projection()
);

// Create the Aggregate with State
$aggregate = new User\Aggregate($user_id, $projector);

$aggregate->change_username('lyonscf1');
$aggregate->change_password('password2');
$aggregate->delete();
$aggregate->undelete();

//$aggregate->create('lyonscf', 'password');

print_r($aggregate);

echo "id: ".$aggregate->id()->toString()."\n";
echo "version: ".$aggregate->version()."\n";

/*

$memory_store = new Store\Adapter\Memory($events);
$file_store = new Store\Adapter\File($file_path);
$eloquent_store = new Store\Adapter\Eloquent($eloquent_model);

$eloquent_stream = $eloquent_store->get_stream_by_id($id);
$eloquent_stream = $eloquent_store->get_stream_by_type($type);
$eloquent_stream = $eloquent_store->get_stream();

$memory_stream = new Stream\Adapter\Memory($events);
$file_stream = new Stream\Adapter\File($file_path);
$eloquent_stream = new Stream\Adapter\Eloquent($eloquent_model);

////////////////////////
////////////////////////
////////////////////////

$user_id = new Uuid(RhumsaaUuid::uuid4());

$eloquent_model = App::make('Store');
$eloquent_store = new Store\Adapter\Eloquent($eloquent_model);
$eloquent_stream = $eloquent_store->get_stream_by_id($id);

// Ruleset

// Setup Projectors, including the State

$projector = new Projection\State\Projector(
	$eloquent_stream
);

$projector->play();

$aggregate = new User\Aggregate(
	$user_id,
	$projector,
	$ruleset
);

$aggregate->change_username('lyonscf1');

try {

	$event_store->transaction_start();

	$event_store->save($aggregate);

	$event_store->transaction_commit();

} catch (\Exception $e)
{
	$event_store->transaction_rollback();

	throw $e;
}

////////////////////////
////////////////////////
////////////////////////

*/


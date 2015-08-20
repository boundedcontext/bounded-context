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

{
	id: '17c39d00-2b4d-11e5-a2cb-0800200c9a66',
    type_id: '02668e8f-8b60-4c46-be4d-94fbb2439fbb',
    occured_at: '2015-07-15T23:57:13+00:00',
    version: 1,
	payload: {
		id: 'a794ef60-2b4d-11e5-a2cb-0800200c9a66',
		first_name: 'Colin',
		last_name: 'Lyons'
	}
}

////////////////////////
////////////////////////
////////////////////////

<?namespace BoundedContext\Sample\Aggregate\Test\Event;

use Sample;

class Upgrader extends AbstractUpgrader
{
    protected $item;
    
    protected function when_v0()
    {
        $this->item->add_property('first_name', null);
        $this->item->add_property('last_name', null);
    }
    
    protected function when_v1()
    {
        $this->item->add_property('email', null);
        $this->item->add_property('username', null);
    }
    
    protected function when_v2()
    {
        $this->item->add_property('full_name', $this->item->first_name .' '. $this->item->last_name);
        
        $this->item->remove_property('first_name');
        $this->item->remove_property('last_name');
    }
    
    public function state()
    {
        return new Event\Sample::from_item($this->item);
    }
}

////////
////////
////////

public function next()
{
    $item = $this->next_item($this->last_id);
    
    $upgrader_class = $this->map->get_upgrader_class($item->type_id());
    
    $upgrader = new $upgrader_class($item);
    $upgrader->run();
    
    return $upgrader->event();
}


//////////////
/////////////
/////////////

// An example of a Workflow
// - When I get a UserCreated event, run a SendEmailNotification command.
        - I need to check that the user has an email address.
        - I need to check


$bounded_context = new BoundedContext(
    $event_stream
);

$bounded_context->command();

public function run()
{
    
}


*/


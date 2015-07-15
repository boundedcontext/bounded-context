<?

namespace BoundedContext\Examples\Recruitment\Aggregate\User\Event;

use BoundedContext\Event;

class UsernameChanged extends Event\AbstractEvent
{
	public $id;
	public $username;

	public function __construct($id, $username)
	{
		$this->id = $id;
		$this->username = $username; 
	}
}

<?

namespace BoundedContext\Examples\Recruitment\Aggregate\User\Event;

use BoundedContext\Event;

class Created extends Event\AbstractEvent
{
	public $id;
	public $username;
	public $password;

	public function __construct($id, $username, $password)
	{
		$this->id = $id;
		$this->username = $username;
		$this->password = $password; 
	}
}

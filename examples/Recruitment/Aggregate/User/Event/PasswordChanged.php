<?

namespace BoundedContext\Examples\Recruitment\Aggregate\User\Event;

use BoundedContext\Event;

class PasswordChanged extends Event\AbstractEvent
{
	public $id;
	public $password;

	public function __construct($id, $password)
	{
		$this->id = $id;
		$this->password = $password; 
	}
}

<?

namespace BoundedContext\Examples\Recruitment\Aggregate\User\Event;

use BoundedContext\Event;

class Undeleted extends Event\AbstractEvent
{
	public $id;

	public function __construct($id)
	{
		$this->id = $id;
	}
}

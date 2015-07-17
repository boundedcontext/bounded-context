<?

namespace BoundedContext\Examples\Recruitment\Aggregate\User\Command;

use BoundedContext\Command;

class Created extends Command\AbstractCommand
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

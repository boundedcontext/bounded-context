<?php

namespace OliveMedia\BoundedContext\Aggregate\Event\Store\Laravel;

use OliveMedia\BoundedContext\Aggregate\Event\Store\Store;

use OliveMedia\BoundedContext\Aggregate\Event\Collection\Collection;
use OliveMedia\BoundedContext\Aggregate\Event\Event;

public function EventStore implements Store 
{

	private $aggregate_state;

	private $table_name = 'aggregate_type_event_store';

	public function __construct(State $s) {
		$this->aggregate_state = $s;
	}

    private function table()
    {
        return DB::table($this->table_name);
    }

	public function get_event_collection(Identity $identity) {

		$event_rows = $this->table()
			->where('aggregate_id', $identity->id())
			->orderBy('occured_on', 'asc');
			->get();

		$event_collection = new Collection();

		foreach($event_rows as $row) {

			$event = $this->hydrate_row($row);
			$event = $this->upgrade_event($event);

			$event_collection->append($event);
		}

		return $event_collection;
	}

	protected function append_to_event_collection(Collection $new_collection) {

		try {

			DB::beginTransaction();

			$current_event_collection = $this->get_event_colection();

			foreach($new_collection as $new_event) {
				$current_event_collection->append($new_event);
			}

			DB::commit();

		} catch (\Exception $e) {
			
			DB::rollback();

			throw $e;
		}
	}

}
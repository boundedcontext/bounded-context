<?php namespace BoundedContext\Event\Log\Adapter;

use BoundedContext\Uuid;
use BoundedContext\Collection;
use BoundedContext\Event\Event;
use BoundedContext\Event\Log\Log;
use BoundedContext\Event\Log\Item;
use Illuminate\Database\Capsule\Manager as Capsule;

class Illuminate implements Log
{

    private $capsule;
    private $connection_name;
    private $table_name;

    public function __construct(Capsule $capsule, $connection_name = 'default', $table_name = 'event_log')
    {
        $this->capsule = $capsule;
        $this->connection_name = $connection_name;
        $this->table_name = $table_name;
    }

    public function table_name()
    {
        return $this->table_name;
    }
    
    public function capsule()
    {
        return $this->capsule;
    }

    public function append_collection(Collection $collection)
    {

        $this->capsule->getConnection($this->connection_name)->transaction(
            function ($connectionManager) use ($collection) {


            foreach ($collection as $event) {
                if (!$event instanceof Event) {
                    throw new \Exception('A Log can only append Items.');
                }

                $item = Item::from_event(
                        Uuid::generate(), new \DateTime, $event
                );

                $connectionManager->table($this->table_name())->insert(
                    [
                        'item' => $item->id()->toString()
                    ]
                );
            }
        }
        );
    }

    public function append_event(Event $event)
    {
        $this->append_collection(
            new Collection(array(
            $event
            ))
        );
    }
}

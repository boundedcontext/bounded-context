<?php namespace BoundedContext\Log\Adapter;

use BoundedContext\Collection\Collection;
use BoundedContext\Log\Item;
use Illuminate\Database\Capsule\Manager as Capsule;

class Illuminate extends Abstracted
{

    private $capsule;
    private $connection_name;
    private $table_name;

    public function __construct(Map $map, Capsule $capsule, $connection_name = 'default', $table_name = 'log')
    {
        parent::__construct($map);

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

    protected function append_item(Item $item)
    {
        $this->capsule->getConnection($this->connection_name)->transaction(
            function ($connectionManager) use ($item) {

            $connectionManager->table($this->table_name())->insert(
                [
                    'item' => json_encode($item->to_array())
                ]
            );
        });
    }

    public function append_collection(Collection $collection)
    {
        $this->capsule->getConnection($this->connection_name)->transaction(
            function ($connectionManager) use ($collection) {

            foreach ($collection as $element) {
                if (!$element instanceof Appendable) {
                    throw new \Exception('A Log can only append appendable Items.');
                }

                $item = $this->generate_item($element);

                $connectionManager->table($this->table_name())->insert(
                    [
                        'item' => json_encode($item->to_array())
                    ]
                );
            }
        });
    }
}

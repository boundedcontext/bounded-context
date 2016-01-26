<?php namespace BoundedContext\Player;

use BoundedContext\Contracts\Player\Player;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Contracts\Player\Snapshot\Repository as SnapshotRepository;
use BoundedContext\Contracts\Player\Factory as PlayerFactory;

class Repository implements \BoundedContext\Contracts\Player\Repository
{
    private $player_factory;
    private $snapshot_repository;

    public function __construct(
        PlayerFactory $player_factory,
        SnapshotRepository $snapshot_repository
    )
    {
        $this->player_factory = $player_factory;
        $this->snapshot_repository = $snapshot_repository;
    }

    public function get(Identifier $id)
    {
        return $this->player_factory->snapshot(
            $this->snapshot_repository->get($id)
        );
    }

    public function save(Player $player)
    {
        $this->snapshot_repository->save(
            $player->snapshot()
        );
    }
}

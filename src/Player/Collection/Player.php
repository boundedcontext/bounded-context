<?php namespace BoundedContext\Player\Collection;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Player\Repository;

class Player implements \BoundedContext\Contracts\Player\Player
{
    protected $player_repository;
    protected $player_identifiers;

    public function __construct(
        Repository $player_repository,
        Collection $player_identifiers
    )
    {
        $this->player_repository = $player_repository;
        $this->player_identifiers = $player_identifiers;
    }

    public function reset()
    {
        foreach($this->player_identifiers as $player_identifier)
        {
            try {

                $player = $this->player_repository->get(
                    $player_identifier
                );

                $player->reset();

                $this->player_repository->save(
                    $player
                );

            } catch(\Exception $e)
            {
                // Send to Airbrake? Then continue.
                dd($e);
            }
        }
    }

    public function play($limit = 1000)
    {
        foreach($this->player_identifiers as $player_identifier)
        {
            try {

                $player = $this->player_repository->get(
                    $player_identifier
                );

                $player->play();

                $this->player_repository->save(
                    $player
                );

            } catch(\Exception $e)
            {
                // Send to Airbrake? Then continue.
                dd($e);
            }
        }
    }

    public function snapshot()
    {
        throw new \Exception("Collection Player Snapshots are not supported.");
    }
}

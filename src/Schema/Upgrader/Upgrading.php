<?php namespace BoundedContext\Schema\Upgrader;

use BoundedContext\Schema\Snapshot;

trait Upgrading
{
    private function get_function_name($version)
    {
        return 'when_version_' . $version->serialize();
    }

    protected function can_upgrade()
    {
        return method_exists(
            $this,
            $this->get_function_name(
                $this->snapshot->version()
            )
        );
    }

    protected function upgrade()
    {
        $function = $this->get_function_name(
            $this->snapshot->version()->serialize()
        );

        if (!method_exists($this, $function)) {
            throw new \Exception('A upgrade handler could not be found.');
        }

        $this->snapshot = new Snapshot(
            $this->$function($this->snapshot->schema()),
            $this->snapshot->version()->increment()
        );
    }
}

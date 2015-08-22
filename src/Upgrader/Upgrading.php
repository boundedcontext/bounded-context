<?php namespace BoundedContext\Upgrader;

trait Upgrading
{
    private function get_function_name($version)
    {
        return 'when_version_' . $version;
    }

    protected function can_upgrade()
    {
        return method_exists(
            $this,
            $this->get_function_name($this->version->toString())
        );
    }

    protected function upgrade()
    {
        $function = $this->get_function_name($this->version->toString());

        if (!method_exists($this, $function)) {
            throw new \Exception('A upgrade handler could not be found.');
        }

        $this->$function($this->schema);
        $this->version->increment();
    }

    public function run()
    {
        while($this->can_upgrade())
        {
            $this->upgrade();
        }
    }

    public function version()
    {
        return $this->version;
    }
}

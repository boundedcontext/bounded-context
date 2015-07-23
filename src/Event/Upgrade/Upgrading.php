<?php namespace BoundedContext\Event\Upgrade;

trait Upgrading
{

    private function get_function_name($version)
    {
        return 'when_version' . $version;
    }

    protected function upgrade(Event $e)
    {

        $function = $this->get_function_name($e);

        if (!method_exists($this, $function)) {
            throw new \Exception('A upgrade handler could not be found.');
        }

        $this->$function($e);

        $this->version += 1;
    }

    public function can_upgrade(Event $e)
    {
        $function = $this->get_function_name($e);

        return method_exists($this, $function);
    }

    public function version()
    {
        return $this->version;
    }
}

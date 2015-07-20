<?php namespace BoundedContext\Handler;

interface Handler
{

    public function handle(Handlable $h);
}

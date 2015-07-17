<?php namespace BoundedContext\Event\Store;

interface Transactable
{

    public function transaction_start();

    public function transaction_commit();

    public function transaction_rollback();
}

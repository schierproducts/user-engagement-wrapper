<?php


namespace Schierproducts\UserEngagementApi\Engineer;


use Schierproducts\UserEngagementApi\Interfaces\Engineer\EngineerInterface;
use Schierproducts\UserEngagementApi\Interfaces\Engineer\EngineerQuery;

interface EngineerProvider
{
    public function list(EngineerQuery $query);

    public function create(EngineerInterface $engineer);

    public function retrieve(int $id);

    public function update(EngineerInterface $engineer, $id = null);

    public function destroy(int $id) : bool;
}

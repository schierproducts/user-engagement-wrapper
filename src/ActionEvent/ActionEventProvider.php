<?php


namespace Schierproducts\UserEngagementApi\ActionEvent;


use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventInterface;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventQuery;

interface ActionEventProvider
{
    public function list(ActionEventQuery $query);

    public function create(ActionEventInterface $actionEvent);

    public function retrieve(int $id);
}

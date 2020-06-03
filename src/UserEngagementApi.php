<?php

namespace Schierproducts\UserEngagementApi;

use Schierproducts\UserEngagementApi\ActionEvent\ActionEvent;

class UserEngagementApi
{
    public $actionEvent;

    public $engineer;

    public function __construct()
    {
        $this->actionEvent = new ActionEvent();
//        $this->engineer
    }
}

<?php

namespace Schierproducts\UserEngagementApi;

use Schierproducts\UserEngagementApi\ActionEvent\ActionEvent;
use Schierproducts\UserEngagementApi\Engineer\Engineer;

class UserEngagementApi
{
    /**
     * @var ActionEvent
     */
    public $actionEvent;

    /**
     * @var Engineer
     */
    public $engineer;

    /**
     * UserEngagementApi constructor.
     */
    public function __construct()
    {
        $this->actionEvent = new ActionEvent();
        $this->engineer = new Engineer();
    }

    /**
     * @return ActionEvent
     */
    public static function actionEvent()
    {
        return new ActionEvent();
    }

    /**
     * @return Engineer
     */
    public static function engineer()
    {
        return new Engineer();
    }
}

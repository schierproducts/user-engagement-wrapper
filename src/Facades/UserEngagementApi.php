<?php

namespace Schierproducts\UserEngagementApi\Facades;

use Illuminate\Support\Facades\Facade;

class UserEngagementApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'user-engagement-api';
    }
}

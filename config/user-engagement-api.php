<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base Url
    |--------------------------------------------------------------------------
    |
    | The base URL where all requests will be routed.
    |
    */

    'base_url' => env('ENGAGEMENT_BASE_URL', 'http://schier-analytics:8888'),

    /*
    |--------------------------------------------------------------------------
    | App Key
    |--------------------------------------------------------------------------
    |
    | The application key that is used to identify and authentication this
    | connection to the API
    |
    */

    'app_key' => env('ENGAGEMENT_APP_KEY', 'key'),

    /*
    |--------------------------------------------------------------------------
    | Log Events
    |--------------------------------------------------------------------------
    |
    | If the engagement api should log events. Can be useful in development environments.
    |
    */

    'log_events' => env('ENGAGEMENT_LOG_EVENTS', true),

];

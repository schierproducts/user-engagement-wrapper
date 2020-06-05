<?php


namespace Schierproducts\UserEngagementApi\Exceptions;

use Exception;

class InvalidEndpoint extends Exception
{
    protected $code = 422;

    /**
     * @return static
     */
    public static function notFound()
    {
        return new static('The endpoint provided could not be found.');
    }
}

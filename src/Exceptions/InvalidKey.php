<?php


namespace Schierproducts\UserEngagementApi\Exceptions;

use Exception;

class InvalidKey extends Exception
{
    protected $code = 401;

    /**
     * @return static
     */
    public static function key()
    {
        return new static("Please provide a valid application key.");
    }
}

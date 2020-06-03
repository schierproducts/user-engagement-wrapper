<?php


namespace Schierproducts\UserEngagementApi\Exceptions;

use Exception;

class InvalidValue extends Exception
{
    /**
     * @param string $field
     * @return static
     */
    public static function expectsArray(string $field)
    {
        return new static("The value for the '$field' is expected to be an array.");
    }

    /**
     * @param string $field
     * @return static
     */
    public static function expectsInteger(string $field)
    {
        return new static("The value for the '$field' is expected to be an integer.");
    }

    /**
     * @param array $validationErrors
     * @return static
     */
    public static function validation(array $validationErrors)
    {
        foreach($validationErrors as $error) {
            return new static($error);
        }
    }
}

<?php


namespace Schierproducts\UserEngagementApi\Exceptions;

use Exception;

class InvalidValue extends Exception
{
    protected $code = 422;

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
        foreach($validationErrors['errors'] as $error) {
            return new static($error);
        }
    }

    /**
     * @param string $field
     * @param string[] $availableValues
     * @return static
     */
    public static function type(string $field, array $availableValues)
    {
        $string = implode(', ', $availableValues);
        return new static("The $field that you have provided is incorrect. The available values are: ".$string);
    }
}

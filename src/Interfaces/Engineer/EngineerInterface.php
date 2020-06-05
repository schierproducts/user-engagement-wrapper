<?php


namespace Schierproducts\UserEngagementApi\Interfaces\Engineer;


use Schierproducts\UserEngagementApi\Enums\UserType;
use Schierproducts\UserEngagementApi\Exceptions\InvalidValue;
use Schierproducts\UserEngagementApi\Interfaces\ModelInterface;

class EngineerInterface
{
    use ModelInterface;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string|null
     */
    public $original_email;

    /**
     * @var string
     */
    public $registered;

    /**
     * @var string|null
     */
    public $phone_number;

    /**
     * @var string[]|null
     */
    public $type;

    /**
     * @var string|null
     */
    public $company;

    /**
     * @var string|null
     */
    public $postal_code;

    /**
     * ActionEventInterface constructor.
     * @param array $array
     */
    public function __construct(array $array = [])
    {
        if (count($array) > 0) {
            $this->first_name = array_key_exists('first_name', $array) ? $array['first_name'] : null;
            $this->last_name = array_key_exists('last_name', $array) ? $array['last_name'] : null;
            $this->email = array_key_exists('email', $array) ? $array['email'] : null;
            $this->original_email = array_key_exists('original_email', $array) ? $array['original_email'] : null;
            $this->registered = array_key_exists('registered', $array) ? $array['registered'] : null;
            $this->phone_number = array_key_exists('phone_number', $array) ? $array['phone_number'] : null;
            if (array_key_exists('type', $array) && !empty($array['type'])) {
                if (!$this->typeIsValid($array['type'])) {
                    throw InvalidValue::type('type', $this->availableTypes());
                }
                $this->type = $array['type'];
            }
            $this->company = array_key_exists('company', $array) ? $array['company'] : null;
            $this->postal_code = array_key_exists('postal_code', $array) ? $array['postal_code'] : null;
        }
    }

    /**
     * @return string[]
     */
    public final function availableTypes()
    {
        return UserType::getValues();
    }
}

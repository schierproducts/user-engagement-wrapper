<?php


namespace Schierproducts\UserEngagementApi\Interfaces\Engineer;


class EngineerInterface
{
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
            $this->registered = array_key_exists('registered', $array) ? $array['registered'] : null;
            $this->phone_number = array_key_exists('phone_number', $array) ? $array['phone_number'] : null;
            $this->type = array_key_exists('type', $array) ? $array['type'] : null;
            $this->company = array_key_exists('company', $array) ? $array['company'] : null;
            $this->postal_code = array_key_exists('postal_code', $array) ? $array['postal_code'] : null;
        }
    }

    /**
     * @return string[]
     */
    public final function availableTypes()
    {
        return [
            'engineerArchitect',
            'contractor',
            'distributor',
            'ahjInspector',
            'facilityOwner',
            'manufacturerRep',
            'other',
            'schierEmployee',
        ];
    }
}

<?php


namespace Schierproducts\UserEngagementApi\Interfaces\Engineer;


use Carbon\Carbon;

class EngineerResult
{
    /**
     * @var int
     */
    public $id;

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
     * @var int
     */
    public $registered;

    /**
     * @var string|null
     */
    public $phone_number;

    /**
     * @var string|null
     */
    public $company;

    /**
     * @var string|null
     */
    public $type;

    /**
     * @var string|null
     */
    public $postal_code;

    /**
     * @var int|null
     */
    public $deleted;

    /**
     * EngineerResult constructor.
     * @param int|string $id
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param int $registered
     * @param null|string $type
     * @param null|string $phone_number
     * @param null|string $company
     * @param null|string $postal_code
     * @param null|int $deleted
     */
    public function __construct($id, string $first_name, string $last_name, string $email, int $registered, $type = null, $phone_number = null, $company = null, $postal_code = null, $deleted = null)
    {
        $this->id = (int) $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->registered = Carbon::createFromTimestamp($registered);
        $this->type = $type;
        $this->phone_number = $phone_number;
        $this->company = $company;
        $this->postal_code = $postal_code;
        $this->deleted = $deleted ? Carbon::createFromTimestamp($deleted) : null;
    }
}

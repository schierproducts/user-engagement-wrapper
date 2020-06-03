<?php


namespace Schierproducts\UserEngagementApi\Interfaces;


use Schierproducts\UserEngagementApi\Exceptions\InvalidValue;

class EngineerQuery
{
    public $offset;

    public $limit;

    public $type;

    /**
     * EngineerQuery constructor.
     * @param int $offset
     * @param int $limit
     * @param null|array $type
     * @throws InvalidValue
     */
    public function __construct(int $offset = 0, int $limit = 50, $type = null)
    {
        $this->offset = $offset;
        $this->limit = $limit;

        if ($type !== null) {
            if (is_array($type)) {
                $this->type = $type;
            } else {
                throw InvalidValue::expectsArray('type');
            }
        }
    }

    /**
     * Compiles all of the elements and returns a string
     *
     * @return int|string
     */
    public function url()
    {
        $url = "?";

        if ($this->offset) {
            $url =+ "offset=".$this->offset."&";
        }
        if ($this->limit) {
            $url =+ "limit=".$this->limit."&";
        }
        if ($this->type) {
            foreach($this->type as $type) {
                $url =+ "type[]=".$type."&";
            }
        }

        return $url;
    }
}

<?php


namespace Schierproducts\UserEngagementApi\Interfaces\ActionEvent;


use Schierproducts\UserEngagementApi\Exceptions\InvalidValue;

class ActionEventQuery
{
    public $offset;

    public $limit;

    public $type;

    public $project;

    public $engineer;

    /**
     * ActionEventQuery constructor.
     * @param int $offset
     * @param int $limit
     * @param null|array $type
     * @param null|int $project
     * @param null|int $engineer
     * @throws InvalidValue
     */
    public function __construct(int $offset = 0, int $limit = 50, $type = null, $project = null, $engineer = null)
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
        if ($project !== null) {
            if (is_string($project)) {
                $this->project = $project;
            } else {
                throw InvalidValue::expectsInteger('project');
            }
        }
        if ($engineer !== null) {
            if (is_integer($engineer)) {
                $this->engineer = $engineer;
            } else {
                throw InvalidValue::expectsInteger('engineer');
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
//        $url = "?";
        $url = "";

        if ($this->offset) {
            $url .= "offset=".$this->offset."&";
        }
        if ($this->project) {
            $url .= "project=".$this->project."&";
        }
        if ($this->engineer) {
            $url .= "engineer=".$this->engineer."&";
        }
        if ($this->limit) {
            $url .= "limit=".$this->limit."&";
        }
        if ($this->type) {
            foreach($this->type as $type) {
                $url .= "type[]=".$type."&";
            }
        }

        return $url;
    }
}

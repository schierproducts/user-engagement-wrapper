<?php


namespace Schierproducts\UserEngagementApi\Interfaces\ActionEvent;


use Carbon\Carbon;

class ActionEventResult
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string|array
     */
    public $meta;

    /**
     * @var int
     */
    public $project;

    /**
     * @var int
     */
    public $engineer;

    /**
     * @var Carbon
     */
    public $created;

    /**
     * ActionEventResult constructor.
     * @param int|string $id
     * @param string $type
     * @param string $description
     * @param int $created
     * @param null|string $meta
     * @param null|int $project
     * @param null|int $engineer
     */
    public function __construct($id, string $type, string $description, $created, $meta = null, $project = null, $engineer = null)
    {
        $this->id = (int) $id;
        $this->type = $type;
        $this->description = $description;
        $this->created = Carbon::createFromTimestamp($created);
        $this->project = $project;
        $this->engineer = $engineer;

        if ($meta) {
            $this->meta = $meta;

            if (is_string($meta)) {
                $this->meta = json_decode($meta);
            }
        }
    }
}

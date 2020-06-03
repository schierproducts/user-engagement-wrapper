<?php


namespace Schierproducts\UserEngagementApi\Interfaces\ActionEvent;


use Schierproducts\UserEngagementApi\Enums\ActionEventType;
use Schierproducts\UserEngagementApi\Exceptions\InvalidValue;
use Schierproducts\UserEngagementApi\Interfaces\ModelInterface;

class ActionEventInterface
{
    use ModelInterface;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int|null
     */
    public $project;

    /**
     * @var int|null
     */
    public $engineer;

    /**
     * @var string|null
     */
    public $meta;

    /**
     * ActionEventInterface constructor.
     * @param array|string $type
     * @param string|null $description
     * @param string|null $project
     * @param string|null $engineer
     * @param array|null $meta
     * @throws InvalidValue
     */
    public function __construct($type, $description = null, $project = null, $engineer = null, $meta = null)
    {
        if (is_array($type)) {
            if (array_key_exists('type', $type)) {
                if (!$this->typeIsValid($type['type'])) {
                    throw InvalidValue::type('type', $this->availableTypes());
                }
                $this->type = $type['type'];
            }
            $this->description = array_key_exists('description', $type) ? $type['description'] : null;
            $this->project = array_key_exists('project', $type) ? $type['project'] : null;
            $this->engineer = array_key_exists('engineer', $type) ? $type['engineer'] : null;
            $this->meta = array_key_exists('meta', $type) ? json_encode($type['meta']) : null;
        } else {
            if (!$this->typeIsValid($type)) {
                throw InvalidValue::type('type', $this->availableTypes());
            }
            $this->type = $type;
            $this->description = $description;
            $this->project = $project;
            $this->engineer = $engineer;
            if ($meta !== null) {
                if (!is_array($meta)) {
                    throw InvalidValue::expectsArray('meta');
                } else {
                    $this->meta = json_encode($meta);
                }
            }
        }
    }

    /**
     * @return string[]
     */
    public final function availableTypes()
    {
        return ActionEventType::getValues();
    }
}

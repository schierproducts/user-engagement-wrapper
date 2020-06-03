<?php


namespace Schierproducts\UserEngagementApi\Interfaces\ActionEvent;


use Schierproducts\UserEngagementApi\Exceptions\InvalidValue;

class ActionEventInterface
{
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
            $this->type = array_key_exists('type', $type) ? $type['type'] : null;
            $this->description = array_key_exists('description', $type) ? $type['description'] : null;
            $this->project = array_key_exists('project', $type) ? $type['project'] : null;
            $this->engineer = array_key_exists('engineer', $type) ? $type['engineer'] : null;
            $this->meta = array_key_exists('meta', $type) ? json_encode($type['meta']) : null;
        } else {
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
     * @return array
     */
    public function toArray()
    {
        $array = [];

        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    /**
     * @return string[]
     */
    public final function availableTypes()
    {
        return [
            'loggedIn',
            'createProject',
            'completedSizing',
            'submittedPreApproval',
            'viewedKickout',
            'addedAddress',
            'cloneProject',
            'closeProject',
            'addedNote',
            'signedUp',
            'viewedProduct',
            'sharedSizing',
            'suggestFeatures',
            'emailClicks',
        ];
    }

    /**
     * @param string $value
     * @return boolean
     */
    private function typeIsValid($value)
    {
        return in_array($value, $this->availableTypes());
    }
}

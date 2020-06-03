<?php


namespace Schierproducts\UserEngagementApi\Interfaces;


trait ModelInterface
{

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
            //
        ];
    }

    /**
     * @param string $value
     * @return boolean
     */
    protected function typeIsValid($value)
    {
        return in_array($value, $this->availableTypes());
    }

}

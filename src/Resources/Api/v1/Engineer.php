<?php

namespace Schierproducts\UserEngagementApi\Resources\Api\v1;

use Schierproducts\UserEngagementApi\Enums\UserType;
use Illuminate\Http\Resources\Json\JsonResource;

class Engineer extends JsonResource
{
    /**
     * Tells Laravel to not wrap the resource in a nested object
     *
     * @var null
     */
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        $type = $this->type ? UserType::getInstance($this->type)->value : null;
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'company' => $this->company,
            'type' => optional(UserType::getInstance($this->type))->value,
            'postal_code' => $this->postal_code,
            'registered' => strtotime($this->registered_at),
            'deleted' => $this->deleted_at ? strtotime($this->deleted_at) : null,
        ];
    }
}

<?php

namespace Schierproducts\UserEngagementApi\Resources\Api\v1;

use Schierproducts\UserEngagementApi\Enums\ActionEventType;
use Illuminate\Http\Resources\Json\JsonResource;

class ActionEvent extends JsonResource
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
        return [
            'id' => $this->id,
            'type' => ActionEventType::getInstance($this->type)->description,
            'description' => $this->description,
            'meta' => $this->meta,
            'project' => $this->project_id,
            'engineer' => $this->engineer_id ? $this->engineer->name() : null,
            'created' => strtotime($this->created_at)
        ];
    }
}

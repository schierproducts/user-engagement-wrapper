<?php

namespace Schierproducts\UserEngagementApi\Resources\Api\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ActionEventCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'object' => 'action-events',
            'data' => $this->collection,
            'url' => '/api/v1/action-event'
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Job extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = parent::toArray($request);
        $response['created_at'] = date('d M Y H:i', strtotime($response['created_at']));
        $response['completed_at'] = isset($response['completed_at']) ? date('d M Y H:i', strtotime($response['completed_at'])) : NULL;
        $response['priority'] = isset($response['priority']) && $response['priority'] === 1;
        return $response;
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MonitorResource extends JsonResource
{
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
            'user' => $this->user,
            'monitor_type' => $this->monitor_type,
            'name' => $this->name,
            'url' => $this->url,
            'contacts' => ContactResource::collection($this->contacts),
        ];
    }
}

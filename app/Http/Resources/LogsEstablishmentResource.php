<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogsEstablishmentResource extends JsonResource
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
            'host' => [
                'name' => $this->host->name, 
                'address' => $this->host->address ,
                'type' => $this->host->type,
                'lat' => $this->host->lat, 
                'lng' => $this->host->lng,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

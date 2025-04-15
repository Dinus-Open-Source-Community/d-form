<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'events' => EventResource::collection($this->whenLoaded('events')),
            'events_count' => $this->whenLoaded('events_count'),
            'events_participants_count' => $this->whenLoaded('events_participants_count'),
            'events_participants' => EventResource::collection($this->whenLoaded('events_participants')),
        ];
    }
}

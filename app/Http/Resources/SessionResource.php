<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
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
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'sessions' => $this->session_status->name,
            'film' => $this->film_id,
            'hall' => $this->hall_id,
            // 'type_hall' => $this->hall->type_hall->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

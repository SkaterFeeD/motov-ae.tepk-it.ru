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
            'film_id' => $this->film->name,
            'hall' => $this->hall->type_hall->type_hall_id->name, // - не работает вообще
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'description'    => $this->description,
            'start_date'     => $this->start_date?->format('Y-m-d H:i'),
            'end_date'       => $this->end_date?->format('Y-m-d H:i'),
            'status'         => $this->is_active ? 'Active' : 'Archived',

            // Calculated meta-data
            'days_remaining' => $this->start_date
                ? now()->diffInDays($this->start_date, false)
                : null,

            // Clean URL for the mobile app
            'logo_url'       => $this->logo ? asset('storage/' . $this->logo) : null,
        ];
    }
}

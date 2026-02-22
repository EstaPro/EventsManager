<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type, // b2b or conference
            'status' => $this->status,
            'time' => $this->scheduled_at->format('H:i'),
            'date' => $this->scheduled_at->format('Y-m-d'),
            'details' => $this->type === 'conference'
                ? new ConferenceResource($this->conference)
                : new CompanyResource($this->company),
        ];
    }
}

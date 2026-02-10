<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConferenceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = $request->user('sanctum');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start_time' => $this->start_time->format('Y-m-d H:i'),
            'location' => $this->location,
            'speaker_company' => $this->company->name ?? 'Organizer',
            'is_attending' => $user ? $this->appointments()->where('visitor_id', $user->id)->exists() : false,
        ];
    }
}
